<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashbaordController;
use App\Http\Controllers\Fortify\TwoFactorAuthCaontroller;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\Productcontroller;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::delete('cart/empty', [CartController::class, 'empty'])->name('cart.empty');
Route::resource('cart', CartController::class);
Route::resource('product', Productcontroller::class);

// Enable two factor authentication
Route::get('two-factor-auth', [TwoFactorAuthCaontroller::class, 'show'])->middleware("auth:web")->name('two-factor-auth');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

require __DIR__ . '/dashboard.php';
// require __DIR__ . '/auth.php';
