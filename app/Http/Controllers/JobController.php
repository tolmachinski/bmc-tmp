<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;

class JobController extends Controller
{
    public function index(string $slug)
    {
        list($id) = explode('-', $slug);
        
        $career = Career::where('id', $id)->where('is_visible', 1)->firstOrFail();
        return view('career', compact(['career']));
        
    }

    public function modal($id)
    {
        $career = Career::where('id', $id)->where('is_visible', 1)->firstOrFail();
        return view('pop-up',compact(['career']));
        
    }

    public function list()
    {
        $careers = Career::where('is_visible', 1)->get();
        
        return view('careers', ['careers' => $careers]);
    }
}
