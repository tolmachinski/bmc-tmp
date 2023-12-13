<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';

    /**
     * Get the daily rate records associated with the rate.
     */
    public function dailyRates()
    {
        return $this->hasMany(DailyRate::class, 'rate_id');
    }
}
