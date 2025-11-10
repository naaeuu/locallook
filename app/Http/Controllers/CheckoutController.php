<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk checkout.');
        }

        // 2. Ambil data keranjang dari form
        $cartData = json_decode($request->input('cart'), true);

        if (empty($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        try {
            // 3. Mulai Transaksi Database
            // Ini memastikan jika 1 produk gagal, semua proses dibatalkan
            DB::beginTransaction();

            foreach ($cartData as $item) {
                // Cari produk di database
                $product = Product::find($item['id']);

                if (!$product) {
                    throw new \Exception("Produk '{$item['name']}' tidak ditemukan.");
                }

                // Cek apakah stok mencukupi
                if ($product->stock < $item['jumlah']) {
                    throw new \Exception("Stok produk '{$item['name']}' tidak mencukupi. Sisa stok: {$product->stock}");
                }

                // 4. KURANGI STOK
                $product->stock -= $item['jumlah'];
                $product->save();
            }

            // 5. Jika semua berhasil, 'commit' perubahan ke database
            DB::commit();

            // 6. Redirect ke halaman sukses (kita buat view-nya)
            // Di sini kita juga akan mengosongkan localStorage, tapi itu harus dilakukan di sisi Klien (JavaScript)
            // Jadi kita kirim 'flash message' untuk memicu JS
            return redirect()->route('home') // Ubah ini ke route 'checkout.success' jika Anda membuatnya
                ->with('success', 'Checkout berhasil! Stok telah diperbarui.')
                ->with('clear_cart', true); // Sinyal untuk JS agar mengosongkan cart

        } catch (\Exception $e) {
            // 7. Jika ada error, batalkan semua perubahan
            DB::rollBack();
            // Kembalikan ke halaman keranjang dengan pesan error
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }
}
