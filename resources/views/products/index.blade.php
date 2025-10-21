@extends('layouts.app')

@section('title', 'Semua Produk - Local Look')

@section('content')

<section class="section" aria-labelledby="all-collection-title">
    <div class="container">
        <h1 id="all-collection-title" class="section-title fade-in" style="--delay: 0s;">Semua Koleksi Kami</h1>

                <div class="filter-bar fade-in" style="--delay: 0.1s;">
            <div class="btn-group" role="group" aria-label="Filter Kategori">
                <button type="button" class="btn btn-outline-maroon active" data-category="all">Semua</button>
                <button type="button" class="btn btn-outline-maroon" data-category="pria">Pria</button>
                <button type="button" class="btn btn-outline-maroon" data-category="wanita">Wanita</button>
                <button type="button" class="btn btn-outline-maroon" data-category="atasan">Atasan</button>
                <button type="button" class="btn btn-outline-maroon" data-category="bawahan">Bawahan</button>
                <button type="button" class="btn btn-outline-maroon" data-category="outer">Outer</button>
            </div>
        </div>

        <div class="row g-4">

            @forelse ($products as $product)
                <div class="col-md-6 col-lg-4 fade-in" data-category="{{ $product->categories }}">
                    {{-- Gunakan slug produk untuk link detail --}}
                    <a href="{{ route('products.show', $product->slug) }}" class="card product-card h-100 text-decoration-none text-reset" role="link">
                        {{-- Gunakan image_url dari database --}}
                        <img src="{{ asset('storage/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            {{-- Gunakan nama produk --}}
                            <h3 class="card-title">{{ $product->name }}</h3>
                            {{-- Gunakan harga produk dengan format Rupiah --}}
                            <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <div class="mt-auto text-center">
                                {{-- Kirim data dinamis ke fungsi JavaScript --}}
                                <button type="button" class="btn btn-maroon btn-sm"
                                        onclick="event.preventDefault(); tambahKeKeranjang(
                                            {{ $product->id }},
                                            {{ json_encode($product->name) }},
                                            {{ $product->price }},
                                            {{ json_encode(asset('storage/' . $product->image_url)) }}
                                     );">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
           
            {{-- Ini akan tampil jika $products kosong --}}
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Saat ini belum ada produk yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('scripts')
{{-- Seluruh script JavaScript Anda di bawah ini sudah benar dan tidak perlu diubah --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    // --- Animasi Scroll Ulang ---
    function handleScrollAnimations() {
        document.querySelectorAll('.fade-in').forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight - 100 && rect.bottom > 0) {
                const delay = el.style.getPropertyValue('--delay') || '0s';
                el.style.transitionDelay = delay;
                el.classList.add('visible');
            } else {
                el.classList.remove('visible');
            }
        });
    }
    window.addEventListener('scroll', handleScrollAnimations);
    handleScrollAnimations();

    // --- Cart Badge & Fungsi Tambah ke Keranjang ---
    function updateCartBadge() {
        const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
        const badge = document.getElementById('cart-badge');
        const total = cart.reduce((sum, item) => sum + (item.jumlah || 0), 0);
        if (total > 0) {
            badge.textContent = total;
            badge.classList.remove('d-none');
        } else {
            badge.classList.add('d-none');
        }
    }

    window.tambahKeKeranjang = function(id, nama, harga, gambar) {
        let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
        let produkAda = keranjang.find(p => p.id === id);
        if (produkAda) {
            produkAda.jumlah++;
        } else {
            keranjang.push({ id, nama, harga, gambar, jumlah: 1 });
        }
        localStorage.setItem('keranjang', JSON.stringify(keranjang));
        alert(`"${nama}" telah ditambahkan ke keranjang.`);
        updateCartBadge();
    };

    updateCartBadge();

    // --- Filter Produk ---
    const filterButtons = document.querySelectorAll('[data-category]');
    const productCards = document.querySelectorAll('.fade-in[data-category]');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const selectedCategory = button.dataset.category;

            productCards.forEach(card => {
                // Cek apakah 'all' atau kategori produk mengandung kategori yang dipilih
                if (selectedCategory === 'all' || card.dataset.category.split(' ').includes(selectedCategory)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
