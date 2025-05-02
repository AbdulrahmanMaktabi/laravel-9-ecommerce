<?php

use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashbaordController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;

Route::prefix('/dashboard')
    ->middleware(['auth', 'auth.type:admin,super-admin', 'verified'])
    ->group(function () {
        Route::get('/', [DashbaordController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

        // Categories Routes
        Route::get('categories/trashed', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::put('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
        Route::resource('categories', CategoryController::class)->except('show');
        Route::put('category/update/status/to/archived/{category}', [CategoryController::class, 'updateStatusToArchived'])->name('categories.updateStatusToArchived');

        // Products Routes
        Route::get('products/trashed', [ProductController::class, 'trash'])->name('products.trash');
        Route::put('products/{category}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::delete('products/{category}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
        Route::resource('products', ProductController::class)->except('show');
        Route::put('product/update/status/to/archived/{category}', [ProductController::class, 'updateStatusToArchived'])->name('products.updateStatusToArchived');

        // Profile Routes
        Route::get('profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });
