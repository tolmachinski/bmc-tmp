<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Html;

class HelpersServiceProvider extends ServiceProvider
{

    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(Html::class);
    }
}
