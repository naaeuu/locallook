<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransNotificationController;

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


/*
|--------------------------------------------------------------------------
| RUTE CHECKOUT BARU (MIDTRANS)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // 1. Halaman Pilih Alamat (Tetap)
    Route::get('/checkout/address', [CheckoutController::class, 'addressForm'])->name('checkout.address');

    // 2. Rute Simpan Alamat Baru (Tetap)
    Route::post('/checkout/address', [CheckoutController::class, 'storeAddress'])->name('checkout.address.store');

    // 3. RUTE BARU: Membuat Pembayaran & Dapat Token (Menggantikan processCheckout)
    Route::post('/checkout/pay', [CheckoutController::class, 'createPayment'])->name('checkout.pay');
});

/*
|--------------------------------------------------------------------------
| RUTE WEBHOOK MIDTRANS
|--------------------------------------------------------------------------
*/
// Rute ini akan dipanggil oleh server Midtrans.
// beri nama 'midtrans.notification' dan JANGAN diberi middleware 'auth' atau 'csrf'
Route::post('/midtrans/notification', [MidtransNotificationController::class, 'handle'])->name('midtrans.notification');


/*
|--------------------------------------------------------------------------
| RUTE AUTENTIKASI BREEZE & ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/products', AdminProductController::class);
});
