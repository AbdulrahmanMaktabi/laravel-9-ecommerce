<?php

namespace App\Providers;

use App\Helpers\Currency;
use App\Services\CurrencyConverterApiService;
use App\Services\LogService;
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

        $this->app->singleton('loggy', function ($app) {
            return new LogService();
        });

        $this->app->singleton('currencyConverter', function ($app) {
            return new CurrencyConverterApiService();
        });

        $this->app->singleton('currencyFormatter', function ($app) {
            return new Currency();
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
