<?php

namespace App\Http\Controllers;

use App\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function getSectionText($section)
    {
        return Section::where('page', "{$section}")->first();;
    }

}
