<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request; // <-- PASTIKAN INI DI-IMPORT

class ProductController extends Controller
{
    /**
     * Menampilkan halaman list semua produk.
     */
    public function index(Request $request) // <-- Tambahkan Request $request
    {
        // Mulai query
        $query = Product::query();

        // Cek jika ada input pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');

            // Modifikasi query untuk mencari di nama ATAU deskripsi
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil hasil, urutkan, dan paginasi
        $products = $query->latest()->paginate(12);

        // Kirim data ke view
        return view('products.index', [
            'products' => $products,
            // Kirim balik search term untuk ditampilkan (opsional)
            'searchTerm' => $request->input('search')
        ]);
    }

    /**
     * Menampilkan halaman detail satu produk.
     */
    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }
}
