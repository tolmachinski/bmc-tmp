<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobApplication;
use Illuminate\Support\Facades\Validator;
use App\Career;
use Mail;

class ModalController extends Controller
{
    

    public function send_apply(Request $request, $id)
    {   
        $email_to = env('MAIL_SEND');
        $email_from = env('MAIL_SENDER');
        $career = Career::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'contact'       => 'required',
            'remarks'       => 'required',
            'document'      => 'required|',
            recaptchaFieldName() => recaptchaRuleName()
        ]);

        $data=$request->all();

        if ($validator->fails()) {
            $errors=$validator->errors();
            return view('pop-up', compact(['career', 'errors', 'data']));
        }

        $apply = new JobApplication();
        $apply->name = $request->input('name');
        $apply->email = $request->input('email');
        $apply->phone = $request->input('contact');
        $apply->remarks = $request->input('remarks');
        $apply->job_id = $career->id;
        
        $document = $request->file('document');
        $path = $document->store('pdf');
        $apply->pdf = $path;

        $apply->save();
        
        Mail::send(
            'apply-job/email',
            [
                'apply'        => $apply,
                'career'       => $career, 
            ],
            function ($message) use ($request,$document, $apply, $career, $email_to, $email_from) {
                $message->from($email_from);
                $message->to($email_to)->subject($career->title." New Application : ".$apply->name);
                $message->attach(storage_path('app/' . $apply->pdf), [
                    'as' => $document->getClientOriginalName(),
                ]);
                
            }
        );

        return view('pop-up', ['success' => true, 'career'=> $career]);
    }

    
    

}
