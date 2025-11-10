@extends('layouts.main')

@section('title', 'Detail Produk - ' . $product->name)

@section('content')

    <div class="container mx-auto px-4 py-16">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 items-start">

                <div class="fade-in">
                    <img src="{{ asset('storage/' . $product->image_url) }}" id="product-image"
                        class="w-full h-auto object-cover rounded-lg shadow-lg" alt="{{ $product->name }}">
                </div>

                <div class="fade-in" style="--delay: 0.1s;">
                    <h1 id="product-name" class="font-heading text-3xl md:text-4xl font-bold text-black mb-2">
                        {{ $product->name }}
                    </h1>

                    <p id="product-price" class="text-maroon font-bold text-3xl mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div id="product-desc" class="text-gray-700 text-base leading-relaxed mb-8 prose">
                        {{-- Menggunakan nl2br untuk menghargai baris baru di deskripsi --}}
                        {!! nl2br(e($product->description)) !!}
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="btn-maroon" {{-- Fungsi ini (tambahKeKeranjang) memanggil dari cart.js --}}
                            onclick="tambahKeKeranjang(
                                {{ $product->id }},
                                {{ json_encode($product->name) }},
                                {{ $product->price }},
                                {{ json_encode(asset('storage/' . $product->image_url)) }}
                            )">
                            <i class="fas fa-cart-plus mr-2"></i>
                            Tambah ke Keranjang
                        </button>
                    </div>

                    <a href="{{ route('products.index') }}"
                        class="inline-block text-maroon hover:text-maroon-dark mt-8 transition-colors duration-300">
                        &larr; Kembali ke Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
