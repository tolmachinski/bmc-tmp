<?php

namespace App\Http\Controllers;

use App\Press;

class PressController extends Controller
{
    public function index()
    {
        $sectionText = (new SectionController())->getSectionText('press');
        $presses = Press::query()->orderBy('created_at', 'desc')->get();

        return view(
            'press/index',
            [
                'sectionText'   => $sectionText,
                'presses'       => $presses,
            ]
        );
    }
}
