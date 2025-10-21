<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- Import model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan halaman list semua produk.
     */
    public function index()
    {
        // Ambil semua produk, urutkan dari yang terbaru, dan paginasi (12 produk per halaman)
        $products = Product::latest()->paginate(12);

        // Kirim data 'products' ke view 'products.index'
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * (Nanti) Menampilkan halaman detail satu produk.
     */
    public function show(Product $product)
    {
        // Laravel otomatis mencari produk berdasarkan slug atau ID
        // Kita perlu buat view 'products.show' untuk ini

        // return view('products.show', [
        //     'product' => $product
        // ]);
    }
}
