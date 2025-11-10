<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <-- PENTING: Jangan lupa import Model Product

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda (homepage).
     */
    public function index()
    {
        // Ambil produk yang kita tandai sebagai "Unggulan" di database
        $featuredProducts = Product::where('is_featured', true)
            ->take(4) // Kita ambil 4 saja untuk homepage
            ->latest() // Ambil yang terbaru
            ->get();

        // Kirim data 'featuredProducts' ke view 'index.blade.php'
        return view('index', [
            'featuredProducts' => $featuredProducts
        ]);
    }

    public function about()
    {
        return view('about');
    }
}
