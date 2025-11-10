<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK KITA
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-lokalook', [HomeController::class, 'about'])->name('about');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart.index');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.store');
/*
|--------------------------------------------------------------------------
| RUTE AUTENTIKASI DARI BREEZE
|--------------------------------------------------------------------------
*/

// Rute Dashboard (halaman setelah login)
Route::get('/dashboard', function () {
    // Nanti kita akan arahkan ini ke homepage saja
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Baris ini memuat semua rute /login, /register, /logout
require __DIR__ . '/auth.php';


// ===================================================
// BARU: GRUP RUTE ADMIN
// ===================================================
Route::middleware(['auth', 'admin'])->group(function () {

    // Prefix 'admin' agar URL-nya menjadi /admin/...
    // Name 'admin.' agar nama rutenya menjadi admin....
    Route::prefix('admin')->name('admin.')->group(function () {

        // Rute: /admin/dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // (Nanti kita akan tambahkan rute CRUD produk di sini)
        // Route::resource('/products', AdminProductController::class);
        Route::resource('/products', AdminProductController::class);
    });
});
