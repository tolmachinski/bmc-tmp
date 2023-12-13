<?php

namespace App\Http\Controllers;

use App\TermsOfUse;
use Illuminate\Http\Request;

class TermsOfUseController extends Controller
{
    public function index()
    {
        $sectionText = (new SectionController)->getSectionText('terms-of-use');

        return view('terms-of-use/index',
            [
                'sectionText'   => $sectionText,
            ]
        );

    }
}
