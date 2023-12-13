<?php

namespace App\Http\Controllers;

use App\Job;
use App\Management;
use App\Testimonial;
use Illuminate\Http\Request;

class TheFirmController extends Controller
{
    public function index()
    {
        $sectionText = (new SectionController)->getSectionText('the-firm');
        $managementSection = (new SectionController)->getSectionText('management');

        $managementType1Records = Management::where('type', 0)->get();
        $managementType2Records = Management::where('type', 1)->get();
        //$testimonials = Testimonial::query()->orderBy('created_at', 'desc')->take(10)->get();

        return view(
            'the-firm/index',
            [
                'sectionText' => $sectionText,
                'managementSection' => $managementSection,
                'managementType1Records' => $managementType1Records,
                'managementType2Records' => $managementType2Records,
                // 'testimonials' => $testimonials,
            ]
        );

    }
}
