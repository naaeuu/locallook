@extends('layouts.main')

@section('title', 'Semua Produk - Local Look')

@section('content')
    <section class="section bg-gray-100" aria-labelledby="all-collection-title">
        <div class="container mx-auto px-4">

            <div class="flex flex-col md:flex-row justify-between items-center mb-8 fade-in">

                {{-- UPDATE: Judul sekarang dinamis --}}
                <h1 id="all-collection-title" class="font-heading text-3xl font-bold text-black mb-4 md:mb-0">
                    {{-- Cek jika variabel $searchTerm ada dan tidak kosong --}}
                    @if (isset($searchTerm) && $searchTerm)
                        Hasil untuk "{{ $searchTerm }}"
                    @else
                        Semua Koleksi Kami
                    @endif
                </h1>

                <div class="flex flex-wrap justify-center gap-2" role="group" aria-label="Filter Kategori">
                    <button type="button" class="btn-outline-maroon active" data-category-filter="all">Semua</button>
                    <button type="button" class="btn-outline-maroon" data-category-filter="pria">Pria</button>
                    <button type="button" class="btn-outline-maroon" data-category-filter="wanita">Wanita</button>
                    <button type="button" class="btn-outline-maroon" data-category-filter="atasan">Atasan</button>
                    <button type="button" class="btn-outline-maroon" data-category-filter="bawahan">Bawahan</button>
                    <button type="button" class="btn-outline-maroon" data-category-filter="outer">Outer</button>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

                @forelse ($products as $product)
                    <div class="fade-in" data-category-product="{{ $product->categories ?? 'all' }}">

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
                        <p class="text-lg">
                            {{-- Pesan dinamis jika tidak ada hasil pencarian --}}
                            @if (isset($searchTerm) && $searchTerm)
                                Oops! Produk dengan nama "{{ $searchTerm }}" tidak ditemukan.
                            @else
                                Saat ini belum ada produk yang tersedia.
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </section>

@endsection
