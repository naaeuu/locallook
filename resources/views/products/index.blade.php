@extends('layouts.app')

@section('title', 'Semua Produk - Local Look')

@section('content')

<section class="section" aria-labelledby="all-collection-title">
    <div class="container">
        <h1 id="all-collection-title" class="section-title fade-in" style="--delay: 0s;">Semua Koleksi Kami</h1>

        <!-- Filter Kategori -->
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

        <!-- Daftar Produk -->
        <div class="row g-4">
            <!-- Kemeja Batik -->
            <div class="col-md-6 col-lg-3 fade-in" data-category="pria atasan">
                <a href="{{ route('products.show', 'P001') }}" class="card product-card h-100 text-decoration-none text-dark" role="link">
                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//86/MTA-12333254/evercloth_evercloth_-_dress_batik_wanita_-_batik_modern_-_batik_couple_-_kebaya_-_reta_dress_standar_full06_lmb2w3k8.jpg" class="card-img-top" alt="Kemeja Batik Parang Modern">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Kemeja Batik</h3>
                        <p class="product-price">Rp 350.000</p>
                        <div class="mt-auto text-center">
                            <button type="button" class="btn btn-maroon btn-sm"
                                    onclick="event.preventDefault(); tambahKeKeranjang('P001', 'Kemeja Batik', 350000, 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//86/MTA-12333254/evercloth_evercloth_-_dress_batik_wanita_-_batik_modern_-_batik_couple_-_kebaya_-_reta_dress_standar_full06_lmb2w3k8.jpg');">
                                Tambah
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Blouse Tenun -->
            <div class="col-md-6 col-lg-4 fade-in" data-category="wanita atasan">
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
            <div class="col-md-6 col-lg-4 fade-in" data-category="pria wanita outer">
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
            <div class="col-md-6 col-lg-4 fade-in" data-category="pria wanita bawahan">
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

            <!-- Tunik Lurik -->
            <div class="col-md-6 col-lg-4 fade-in" data-category="wanita atasan">
                <a href="{{ route('products.show', 'P005') }}" class="card product-card h-100 text-decoration-none text-dark" role="link">
                    <img src="https://images.unsplash.com/photo-1617137968427-85924c800a22?q=80&w=1974&auto=format&fit=crop" class="card-img-top" alt="Tunik Lurik Klasik">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Tunik Lurik "Klasik"</h3>
                        <p class="product-price">Rp 380.000</p>
                        <div class="mt-auto text-center">
                            <button type="button" class="btn btn-maroon btn-sm btn-with-icon"
                                    onclick="event.preventDefault(); tambahKeKeranjang('P005', 'Tunik Lurik Klasik', 380000, 'https://images.unsplash.com/photo-1617137968427-85924c800a22?q=80&w=1974&auto=format&fit=crop');">
                                Tambah <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Dress Pantai -->
            <div class="col-md-6 col-lg-4 fade-in" data-category="wanita atasan">
                <a href="{{ route('products.show', 'P006') }}" class="card product-card h-100 text-decoration-none text-dark" role="link">
                    <img src="https://images.unsplash.com/photo-1525455246237-6e2ab308babd?q=80&w=1974&auto=format&fit=crop" class="card-img-top" alt="Dress Pantai Flores">
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title">Dress Pantai "Flores"</h3>
                        <p class="product-price">Rp 450.000</p>
                        <div class="mt-auto text-center">
                            <button type="button" class="btn btn-maroon btn-sm btn-with-icon"
                                    onclick="event.preventDefault(); tambahKeKeranjang('P006', 'Dress Pantai Flores', 450000, 'https://images.unsplash.com/photo-1525455246237-6e2ab308babd?q=80&w=1974&auto=format&fit=crop');">
                                Tambah <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </a>
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
