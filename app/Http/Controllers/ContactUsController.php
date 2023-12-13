<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $sectionText = (new SectionController())->getSectionText('contact-us');
        $contactUs = ContactUs::all();

        return view(
            'contact-us/index',
            [
                'sectionText'   => $sectionText,
                'contactUs'     => $contactUs,
            ]
        );
    }

    public function send_email(Request $request)
    {
        $email = env('MAIL_SEND');
        $email_sender = env('MAIL_SENDER');

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'email' => 'required|email',
            'contact_number' => 'required',
            'description' => 'required',
            recaptchaFieldName() => recaptchaRuleName(),
        ]);

        $data = $request->all();
        $sectionText = (new SectionController())->getSectionText('contact-us');
        $contactUs = ContactUs::all();

        if ($validator->fails()) {
            $errors = $validator->errors();

            return view('contact-us/index', [
                'sectionText' => $sectionText,
                'contactUs' => $contactUs,
                'data' => $data,
                'errors' => $errors,
            ]);
        }

        $content = strtolower($request->description);

        $urlPattern = '/((http|https)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/';

        $containsLinks = preg_match($urlPattern, $content);
        $containsClick = strpos($content, 'click');
        $containsFree = strpos($content, 'free');

        if ($containsLinks || $containsClick || $containsFree) {
            return redirect('/contact-us#success');
        }
        
        Mail::send('contact-us/email', [
            'subject' => $request->subject,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'description' => $request->description,
        ], function ($message) use ($request, $email, $email_sender) {
            $message->from($email_sender);
            $message->to($email)->subject('CONTACT FROM BMC WEBSITE - TEST');
        });

        return redirect('/contact-us#success')->with('success', 'You have successfully submitted your contact details. Someone will be in contact with you soon.');
    }
}
