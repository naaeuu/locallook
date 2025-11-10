<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Ambil semua produk dari database, urutkan dari yang terbaru
        $products = Product::latest()->paginate(10); // Paginate 10 produk per halaman

        // 2. Kirim data 'products' ke view 'admin.products.index'
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 3. VALIDASI DATA
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB Max
            'is_featured' => 'nullable|boolean',
        ]);

        // 4. BUAT SLUG
        // "Kemeja Batik Pria" -> "kemeja-batik-pria"
        $validated['slug'] = Str::slug($validated['name']);

        // 5. HANDLE UPLOAD GAMBAR
        if ($request->hasFile('image_url')) {
            // Simpan gambar di 'public/products'
            // 'storage/products/namafile.jpg'
            $path = $request->file('image_url')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        // 6. SET 'is_featured'
        // Jika checkbox tidak dicentang, nilainya null. Kita ubah jadi 0 (false).
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        // 7. SIMPAN KE DATABASE
        Product::create($validated);

        // 8. KEMBALI KE HALAMAN INDEX
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // 3. VALIDASI DATA
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            // Gambar tidak 'required' saat update
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);

        // 4. BUAT SLUG JIKA NAMA BERUBAH
        if ($request->name != $product->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // 5. HANDLE UPLOAD GAMBAR BARU (JIKA ADA)
        if ($request->hasFile('image_url')) {
            // Hapus gambar lama
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }

            // Simpan gambar baru
            $path = $request->file('image_url')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        // 6. SET 'is_featured'
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;

        // 7. UPDATE DATABASE
        $product->update($validated);

        // 8. KEMBALI KE HALAMAN INDEX
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // 1. HAPUS GAMBAR DARI STORAGE
        // Cek jika ada gambar dan hapus
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        // 2. HAPUS PRODUK DARI DATABASE
        $product->delete();

        // 3. KEMBALI KE HALAMAN INDEX DENGAN PESAN SUKSES
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
