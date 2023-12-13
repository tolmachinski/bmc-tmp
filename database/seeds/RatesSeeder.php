<?php

use Illuminate\Database\Seeder;
use App\Rate;

class RatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = [
            new Rate(['type' => 'six_month_libor', 'label' => '6 MO LIBOR']),
            new Rate(['type' => 'prime_rate', 'label' => 'Prime Rate']),
            new Rate(['type' => 'five_yr_tr', 'label' => '5 YR TR']),
            new Rate(['type' => 'ten_yr_tr', 'label' => '10 YR TR']),
            new Rate(['type' => 'five_year_swap', 'label' => '5 YR SWAP']),
            new Rate(['type' => 'ten_year_swap', 'label' => '10 YR SWAP']),
        ];

        foreach ($rates as $rate) {
            $rate->save();
        }
    }
}
