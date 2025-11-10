@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
    <h1 class="font-heading text-3xl font-bold text-black mb-6">
        Edit Produk: {{ $product->name }}
    </h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops! Ada yang salah:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Edit --}}
        {{-- Arahkan ke route 'admin.products.update' dengan method PUT --}}
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- PENTING: Method Spoofing for Update --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Kolom Kiri --}}
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        {{-- Isi value dengan data lama --}}
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                            required class="search-bar-input py-3">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                            required class="search-bar-input py-3">
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                            required class="search-bar-input py-3">
                    </div>

                    <div>
                        <label for="categories" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <input type="text" name="categories" id="categories"
                            value="{{ old('categories', $product->categories) }}" class="search-bar-input py-3"
                            placeholder="Contoh: pria atasan outer">
                    </div>

                    <div>
                        <label for="is_featured" class="flex items-center gap-2 text-sm font-medium text-gray-700">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                class="rounded text-maroon focus:ring-maroon"
                                {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            Tampilkan di Halaman Depan (Unggulan)
                        </label>
                    </div>
                </div>

                {{-- Kolom Kanan --}}
                <div class="space-y-4">
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="6" class="search-bar-input py-3">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label for="image_url" class="block text-sm font-medium text-gray-700">Ganti Gambar Produk
                            (Opsional)</label>
                        <input type="file" name="image_url" id="image_url"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-3 file:px-4 file:rounded-l-lg file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gambar Saat Ini</label>
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                            class="mt-2 w-32 h-32 object-cover rounded-lg">
                    </div>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="btn-outline-maroon py-2 px-6 text-sm">
                    Batal
                </a>
                <button type="submit" class="btn-maroon py-2 px-6 text-sm">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
@endsection
