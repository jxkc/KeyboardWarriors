<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashController::class, 'index']);

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
    Route::post('/basket', [BasketController::class, 'store'])->name('basket.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // Route::post('/products', [ProductController::class, 'store'])->name('products.store'); //not needed atm
    Route::get('/products/manage', [ProductController::class, 'manage'])->name('products.manage');
    Route::post('/products/manage', [ProductController::class, 'store'])->name('products.manage.store');
});

require __DIR__.'/auth.php';
