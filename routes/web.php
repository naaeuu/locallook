<?php

use Illuminate\Support\Facades\Route;

// Route Home
Route::get('/', function () {
    return view('index');
})->name('home');

// Route Produk
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

// Route Detail Produk
Route::get('/products/{slug}', function ($slug) {
    return view('products.show');
})->name('products.show');

// Route Keranjang
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');
