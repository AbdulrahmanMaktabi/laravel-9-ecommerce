<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashbaordController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', [DashbaordController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

        // Categories Routes
        Route::resource('categories', CategoryController::class);
    });
require __DIR__ . '/auth.php';
