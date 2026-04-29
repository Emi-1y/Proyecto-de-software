<?php

// Author: Emily Cardona Castañeda 

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ───────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('service.index');
});

// ─── AUTH ─────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ─── AUTHENTICATED USER ───────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {

    // Cart
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::put('/update/{product}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
    });

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
        Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('order.show');
    });

    // Reviews
    Route::prefix('reviews')->group(function () {
        Route::get('/create/{product}', [ReviewController::class, 'create'])->name('review.create');
        Route::post('/store/{product}', [ReviewController::class, 'store'])->name('review.store');
    });
});

// ─── ADMIN ────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'checkAdmin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        // Products
        Route::prefix('products')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('admin.product.index');
            Route::get('/create', [AdminProductController::class, 'create'])->name('admin.product.create');
            Route::post('/', [AdminProductController::class, 'store'])->name('admin.product.store');
            Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
            Route::put('/{product}', [AdminProductController::class, 'update'])->name('admin.product.update');
            Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
        });

        // Categories
        Route::prefix('categories')->group(function () {
            Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category.index');
            Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
            Route::post('/', [AdminCategoryController::class, 'store'])->name('admin.category.store');
            Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
        });

        // Services
        Route::prefix('services')->group(function () {
            Route::get('/', [AdminServiceController::class, 'index'])->name('admin.service.index');
            Route::get('/create', [AdminServiceController::class, 'create'])->name('admin.service.create');
            Route::post('/', [AdminServiceController::class, 'store'])->name('admin.service.store');
            Route::get('/{service}/edit', [AdminServiceController::class, 'edit'])->name('admin.service.edit');
            Route::put('/{service}', [AdminServiceController::class, 'update'])->name('admin.service.update');
            Route::delete('/{service}', [AdminServiceController::class, 'destroy'])->name('admin.service.destroy');
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin.order.index');
            Route::get('/{order}/edit', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
            Route::put('/{order}', [AdminOrderController::class, 'update'])->name('admin.order.update');
        });

        // Users
        Route::prefix('users')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.index');
            Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
        });
    });

