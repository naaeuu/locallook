<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // <-- 1. Import model Product
use Illuminate\Support\Facades\DB; // <-- 2. Import DB facade

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // 1. Kosongkan tabel produk dulu (opsional, tapi disarankan)
        // Ini mencegah data duplikat setiap kali Anda menjalankan seeder
        DB::table('products')->truncate();

        // 2. Buat data produk menggunakan model Product
        Product::create([
            'name' => 'Kemeja Batik',
            'slug' => 'kemeja-batik-01',
            'description' => 'Kemeja batik katun premium dengan motif parang modern.',
            'price' => 350000,
            'stock' => 40,
            'is_featured' => true,
            'image_url' => 'products/kameja_batik.jpg', // Pastikan gambar ini ada di storage/app/public/products/
        ]);

        Product::create([
            'name' => 'Blouse Tenun',
            'slug' => 'blouse-tenun-01',
            'description' => 'Blouse cantik dari kain tenun asli.',
            'price' => 425000,
            'stock' => 50,
            'is_featured' => true,
            'image_url' => 'products/blous_tenun.jpg', // Ganti dengan path gambar Anda
        ]);

        Product::create([
            'name' => 'Celana Kulot',
            'slug' => 'celana-kulot-01',
            'description' => 'Celana kulot bahan linen yang adem dan nyaman.',
            'price' => 275000,
            'stock' => 30,
            'is_featured' => true,
            'image_url' => 'products/celana_kulot.jpeg', // Ganti dengan path gambar Anda
        ]);

        Product::create([
            'name' => 'Outer Kimono',
            'slug' => 'outer-kimono-01',
            'description' => 'Outer bergaya kimono unisex dengan bahan ringan.',
            'price' => 299000,
            'stock' => 100,
            'is_featured' => true,
            'image_url' => 'products/outer_kimono.webp', // Ganti dengan path gambar Anda
        ]);
    }
}
