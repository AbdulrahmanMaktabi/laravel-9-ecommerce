<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MediaService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('media', function ($app) {
            return new MediaService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
