@extends('layouts.app')

@section('title', 'Local Look - Gaya Khas Nusantara')

@section('content')

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

<section id="featured-products" class="section" style="background-color: var(--white);" aria-labelledby="featured-products-title">
    <div class="container">
        <h2 id="featured-products-title" class="section-title fade-in">Koleksi Unggulan Kami</h2>
        <div class="row g-4">
            <!-- Kemeja Batik -->
            <div class="col-md-6 col-lg-3 fade-in" style="--delay: 0.1s;">
                <a href="{{ route('products.show', 'P001') }}" class="card product-card h-100 text-decoration-none text-dark" role="link">
                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//86/MTA-12333254/evercloth_evercloth_-_dress_batik_wanita_-_batik_modern_-_batik_couple_-_kebaya_-_reta_dress_standar_full06_lmb2w3k8.jpg" class="card-img-top" alt="Kemeja Batik Parang Modern">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Kemeja Batik</h3>
                        <p class="product-price">Rp 350.000</p>
                        <div class="mt-auto text-center">
                            <button type="button" class="btn btn-maroon btn-sm btn-with-icon"
                                    onclick="event.preventDefault(); tambahKeKeranjang('P001', 'Kemeja Batik', 350000, 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//86/MTA-12333254/evercloth_evercloth_-_dress_batik_wanita_-_batik_modern_-_batik_couple_-_kebaya_-_reta_dress_standar_full06_lmb2w3k8.jpg');">
                                Tambah <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Blouse Tenun -->
            <div class="col-md-6 col-lg-3 fade-in" style="--delay: 0.2s;">
                <a href="{{ route('products.show', 'P002') }}" class="card product-card h-100 text-decoration-none text-dark" role="link">
                    <img src="https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?q=80&w=1974&auto=format&fit=crop" class="card-img-top" alt="Blouse Tenun Sumba Elegan">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Blouse Tenun "Sumba Elegan"</h3>
                        <p class="product-price">Rp 425.000</p>
                        <div class="mt-auto text-center">
                            <button type="button" class="btn btn-maroon btn-sm btn-with-icon"
                                    onclick="event.preventDefault(); tambahKeKeranjang('P002', 'Blouse Tenun Sumba Elegan', 425000, 'https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?q=80&w=1974&auto=format&fit=crop');">
                                Tambah <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Outer Kimono -->
            <div class="col-md-6 col-lg-3 fade-in" style="--delay: 0.3s;">
                <a href="{{ route('products.show', 'P003') }}" class="card product-card h-100 text-decoration-none text-dark" role="link">
                    <img src="https://images.unsplash.com/photo-1620799140188-3b2a02fd9a77?q=80&w=1972&auto=format&fit=crop" class="card-img-top" alt="Outer Kimono Nusa Dua">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Outer Kimono "Nusa Dua"</h3>
                        <p class="product-price">Rp 299.000</p>
                        <div class="mt-auto text-center">
                            <button type="button" class="btn btn-maroon btn-sm btn-with-icon"
                                    onclick="event.preventDefault(); tambahKeKeranjang('P003', 'Outer Kimono Nusa Dua', 299000, 'https://images.unsplash.com/photo-1620799140188-3b2a02fd9a77?q=80&w=1972&auto=format&fit=crop');">
                                Tambah <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Celana Kulot -->
            <div class="col-md-6 col-lg-3 fade-in" style="--delay: 0.4s;">
                <a href="{{ route('products.show', 'P004') }}" class="card product-card h-100 text-decoration-none text-dark" role="link">
                    <img src="https://images.jualaku.id/media/file/2023/562acb47-a956-4bef-8df3-fa2eb7212e60.jpg" class="card-img-top" alt="Celana Kulot Senja">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Celana Kulot</h3>
                        <p class="product-price">Rp 275.000</p>
                        <div class="mt-auto text-center">
                            <button type="button" class="btn btn-maroon btn-sm btn-with-icon"
                                    onclick="event.preventDefault(); tambahKeKeranjang('P004', 'Celana Kulot Senja', 275000, 'https://images.jualaku.id/media/file/2023/562acb47-a956-4bef-8df3-fa2eb7212e60.jpg');">
                                Tambah <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

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
