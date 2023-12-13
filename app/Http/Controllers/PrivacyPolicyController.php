<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $sectionText = (new SectionController)->getSectionText('privacy-policy');

        return view('privacy-policy/index',
            [
                'sectionText'   => $sectionText,
            ]
        );
    }
}
