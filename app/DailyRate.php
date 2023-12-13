<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DailyRate extends Model
{
    protected $table = 'daily_rates';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];

    /**
     * Get the blog post record associated with the image.
     */
    public function rate()
    {
        return $this->belongsTo(Rate::class, 'rate_id');
    }

    /**
     * Scope a query to only include latest daily rates
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTodayRate(Builder $query)
    {
        $now = new \DateTime();

        return $query->with('rate')->where('date', $now->format('Y-m-d'))->orderBy('rate_id');
    }
}
