<?php

namespace App\Http\Controllers;

use App\LoanQuestion;
use App\LoanProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;

class LoanProgramController extends Controller
{
    public function index()
    {

        $loanPrograms = LoanProgram::all();
        $sectionText = (new SectionController)->getSectionText('loan-programs');
        

        return view('loan-programs/index',
            [
                
                'loanPrograms' => $loanPrograms,
                'sectionText'   => $sectionText,
            ]
        );
    }

    public function modal($id)
    {   
        $loanPrograms = LoanProgram::all();
        $currentProgram = LoanProgram::where('id', $id)->firstOrFail();

        return view('loan-programs/modal-loan',
            [
                'loanPrograms' => $loanPrograms,
                'currentProgram' => $currentProgram,
            ]
        );
    }

    public function send_question(Request $request, $id)
    {   
        $loanPrograms = LoanProgram::all();
        $email_to = env('MAIL_SEND');
        $email_from = env('MAIL_SENDER');
        $currentProgram = LoanProgram::findOrFail($id);
        
        
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'contact'       => 'required',
            'question'      => 'required',
            'loan_id'       => 'required',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        $data=$request->all();

        if ($validator->fails()) {
            $errors=$validator->errors();
            return view('loan-programs/modal-loan', compact(['currentProgram','loanPrograms', 'errors', 'data']));
        }

        $question = new LoanQuestion();
        $question->name = $request->input('name');
        $question->email = $request->input('email');
        $question->contact = $request->input('contact');
        $question->question = $request->input('question');
        $question->loan_id = $request->input('loan_id');

        $question->save();
        
        Mail::send(
            'loan-programs/email',
            [
                'question'        => $question,
                'loanProgram'     => $currentProgram,
            ],
            
            function ($message) use ($request, $question, $currentProgram, $email_to, $email_from) {
                $message->from($email_from);
                $message->to($email_to)->subject($currentProgram->title." Question from : ". $question->name);
             
            }
        );
        
        return view('loan-programs/modal-loan', ['success' => true]);
    }
}
