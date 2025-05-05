<?php

namespace App\Providers;

use App\Models\Cart;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * store '/app/Repositories/Cart/CartRepository.php in service container & dependecy injection
         * so now when call CartRepository $cart in any function in app for example ->
         * index(CartRepository $cart) = this mean to call `CartModelRepository` becuse its stored in service container
         * NOTE: dont forget to include the cartServiceProvider config/app.php inside providers section.
         */
        $this->app
            ->singleton(CartRepository::class, function ($app) {
                return new CartModelRepository();
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
