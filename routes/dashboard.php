<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashbaordController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Fortify\TwoFactorAuthCaontroller;

Route::prefix('/admin/dashboard')
    // define which guard type
    ->middleware(['auth:admin'])
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

        // Roles Routes
        Route::resource('roles', RoleController::class);

        // Users Routes
        Route::resource('users', UserController::class)->except(['create', 'store']);

        // Admins Routes
        Route::resource('admins', AdminController::class)->except(['create', 'store']);

        // Profile Routes
        Route::get('profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

        // Two Factor Authentication Routes
        Route::get('two-factor-auth', [TwoFactorAuthCaontroller::class, 'show'])
            ->name('admin.two-factor-auth');
    });
