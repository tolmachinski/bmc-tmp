<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\MainPageBlock;
use App\DailyRate;
use Illuminate\Support\Collection;
use App\Testimonial;

class Home extends Controller
{
    public function index(Request $request)
    {
        $testimonials = Testimonial::query()->orderBy('created_at', 'desc')->take(10)->get();
        $blocks = [
            'banner' => MainPageBlock::whereIn('type', ['banner'])->orderBy('type')->get(),
            'top' => MainPageBlock::whereIn('type', ['featured-transactions'])->orderBy('type', 'desc')->get(),
            'center' => MainPageBlock::whereIn('type', ['center-left', 'center-right'])->orderBy('type')->get(),
            //'bottom' => MainPageBlock::whereIn('type', ['bottom-right'])->orderBy('type')->get(),
        ];

        $featuredTransactions = Transaction::where('is_featured', 1)->take(3)->orderBy('id', 'desc')->get();

        // foreach ($blocks->where('type', 'bottom-left') as $block) {
        //     $calculated = [];
        //     foreach ($block->content as $key => $text) {
        //         list($part, $type) = explode('::', $key);
        //         $calculated[$part][$type] = $text;
        //     }

        //     $block->calculated = $calculated;
        // }
        // foreach ($blocks->whereIn('type', 'bottom-left') as $block) {
        //     $calculated = [];
        //     foreach ($block->content as $key => $text) {
        //         list($part, $type) = explode('::', $key);
        //         $calculated[$part][$type] = $text;
        //     }

        //     $block->calculated = $calculated;
        // }

        $rateSnapshot = new Collection();
        foreach (DailyRate::todayRate()->get() as $dailyRate) {
            $rateSnapshot->put($dailyRate->rate->type, $dailyRate);
        }

        return view('home.welcome')
            ->with('currPage', 'home')
            ->with('blocks', $blocks)
            ->with('today', new \DateTime())
            ->with('rateSnapshot', $rateSnapshot)
            ->with('featuredTransactions', $featuredTransactions)
            ->with('testimonials', $testimonials);
    }
}
