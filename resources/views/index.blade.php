@extends('layouts.app')

@section('title', 'Local Look - Gaya Khas Nusantara')

@section('content')

{{-- Bagian Hero dan About tidak berubah --}}
<header class="hero-section" role="banner">
    <div class="container fade-in" style="--delay: 0s;">
        <h1>Temukan Gaya, Dukung Lokal</h1>
        <p>Temukan koleksi eksklusif yang memadukan tren fashion terkini dengan keindahan budaya lokal.</p>
        <a href="{{ route('products.index') }}" class="btn btn-maroon" role="button">Lihat Koleksi</a>
    </div>
</header>

<section id="about" class="section" aria-labelledby="about-title">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 fade-in">
                <h2 id="about-title" class="section-title text-start">Tentang Local Look</h2>
                <p><strong>Local Look</strong> adalah platform digital yang hadir untuk memberdayakan brand fashion lokal melalui kolaborasi bersama micro-influencer kampus.</p>
                <p>Dengan menggabungkan kekuatan teknologi dan komunitas, kami membantu brand UMKM menjangkau audiens Gen Z dan milenial secara lebih efektif.</p>
            </div>
            <div class="col-md-6 text-center fade-in" style="--delay: 0.2s;">
                <img src="{{ asset('tentang.jpg') }}" class="img-fluid rounded-3" alt="Tim Local Look" loading="lazy">
            </div>
        </div>
    </div>
</section>

{{-- Bagian Koleksi Unggulan dengan struktur Bootstrap --}}
<section id="featured-products" class="section bg-white" aria-labelledby="featured-products-title">
    <div class="container">
        <h2 id="featured-products-title" class="section-title">Koleksi Unggulan Kami</h2>

        <div class="row g-4">

            @forelse ($featuredProducts as $product)
                <div class="col-md-6 col-lg-4 fade-in">
                    <a href="{{ route('products.show', $product->slug) }}"
                       class="card product-card h-100 text-decoration-none text-reset">
                        <img src="{{ asset('storage/' . $product->image_url) }}"
                             alt="{{ $product->name }}"
                             class="card-img-top">
                        <div class="card-body text-center d-flex flex-column">
                            <h3 class="card-title">{{ $product->name }}</h3>
                            <p class="product-price mt-auto">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>Produk unggulan akan segera hadir!</p>
                </div>
            @endforelse

        </div>
        <div class="text-center mt-5 fade-in">
            <a href="{{ route('products.index') }}" class="btn btn-maroon" role="button">
                Lihat Selengkapnya
            </a>
        </div>
    </div>
</section>

{{-- Bagian Why Us tidak berubah --}}
<section id="why-us" class="section" aria-labelledby="why-us-title">
    <div class="container">
        <h2 id="why-us-title" class="section-title fade-in">Kenapa Memilih Kami?</h2>
        <div class="row g-4">
            <div class="col-md-4 fade-in" style="--delay: 0.1s;">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-gem"></i></div>
                    <h3 class="feature-title">Kualitas Terbaik</h3>
                    <p>Kami menggunakan bahan-bahan premium dan dikerjakan oleh pengrajin berpengalaman.</p>
                </div>
            </div>
            <div class="col-md-4 fade-in" style="--delay: 0.2s;">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-palette"></i></div>
                    <h3 class="feature-title">Desain Eksklusif</h3>
                    <p>Setiap koleksi dirancang secara unik dengan sentuhan budaya nusantara.</p>
                </div>
            </div>
            <div class="col-md-4 fade-in" style="--delay: 0.3s;">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                    <h3 class="feature-title">Pelayanan Cepat & Responsif</h3>
                    <p>Admin kami siap merespon pesanan Anda melalui WhatsApp dengan cepat.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
{{-- Script tidak berubah --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    // --- Animasi Scroll Ulang Setiap Kali Scroll ---
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
});
</script>
@endpush
