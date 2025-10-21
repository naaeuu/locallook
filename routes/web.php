<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Route Keranjang
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');
