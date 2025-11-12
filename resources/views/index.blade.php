@extends('layouts.main')
@section('title', 'Local Look - Gaya Khas Nusantara')
@section('content')

    <section id="featured-products" class="section bg-gray-100" aria-labelledby="featured-products-title">
        <div class="container mx-auto px-4">

            <a href="#" class="recommendation-banner fade-in">
                <h2 id="featured-products-title" class="text-2xl font-bold">Rekomendasi Produk Lokal</h2>
                <i class="fas fa-chevron-right text-2xl"></i>
            </a>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

                @forelse ($featuredProducts as $product)
                    <div class="fade-in">
                        <div class="product-card group">
                            <a href="{{ route('products.show', $product->slug) }}" class="flex flex-col flex-1 h-full">
                                <div class="relative overflow-hidden rounded-t-lg">
                                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                        class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>

                                <div class="p-4 flex flex-col flex-1">
                                    <div>
                                        <h3 class="product-card-title">{{ $product->name }}</h3>
                                        <p class="product-card-stock">Stok: {{ $product->stock }}</p>
                                    </div>
                                    <p class="product-card-price mt-auto">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </a>

                            <div class="px-4 pb-4">
                                <button type="button" class="btn-maroon text-sm w-full py-2"
                                    onclick="tambahKeKeranjang(
                                        {{ $product->id }},
                                        {{ json_encode($product->name) }},
                                        {{ $product->price }},
                                        {{ json_encode(asset('storage/' . $product->image_url)) }}
                                    );">
                                    + Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 md:col-span-3 lg:col-span-5 text-center text-gray-500 py-16">
                        <p class="text-lg">Produk unggulan akan segera hadir!</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12 fade-in">
                <a href="{{ route('products.index') }}" class="btn-maroon" role="button">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>

@endsection
