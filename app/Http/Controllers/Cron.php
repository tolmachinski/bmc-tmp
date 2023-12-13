<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class Cron extends Controller
{
    public function index()
    {
        Artisan::call('daily-rates:parse');
    }
}
