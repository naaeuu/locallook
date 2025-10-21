@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->name)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 fade-in">
            <img src="{{ asset('storage/' . $product->image_url) }}"
                 id="product-image"
                 class="img-fluid rounded shadow"
                 alt="{{ $product->name }}">
        </div>
        <div class="col-md-6 fade-in" style="--delay: 0.1s;">
            <h1 id="product-name">{{ $product->name }}</h1>
            <p class="text-maroon fw-bold fs-4" id="product-price">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
            <p id="product-desc">{{ $product->description }}</p>

            <button class="btn btn-maroon px-4 py-2"
                    onclick="tambahKeKeranjang(
                        {{ $product->id }},
                        {{ json_encode($product->name) }},
                        {{ $product->price }},
                        {{ json_encode(asset('storage/' . $product->image_url)) }}
                    )">
                Tambah ke Keranjang
            </button>

            <a href="{{ route('products.index') }}" class="d-block mt-3">← Kembali ke Produk</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{--
=====================================================================
SCRIPT DI BAWAH INI SUDAH BENAR DAN TIDAK PERLU DIUBAH
=====================================================================
--}}
<script>
// Fungsi global agar bisa dipanggil dari onclick
window.tambahKeKeranjang = function(id, nama, harga, gambar) {
    let cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    let existing = cart.find(item => item.id === id);
    if (existing) {
        existing.jumlah++;
    } else {
        cart.push({ id, nama, harga, gambar, jumlah: 1 });
    }
    localStorage.setItem('keranjang', JSON.stringify(cart));
    alert(`"${nama}" ditambahkan ke keranjang!`);
    updateCartBadge();
};

function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    const total = cart.reduce((sum, item) => sum + (item.jumlah || 0), 0);
    const badge = document.getElementById('cart-badge');
    if (badge) {
        if (total > 0) {
            badge.textContent = total;
            badge.classList.remove('d-none');
        } else {
            badge.classList.add('d-none');
        }
    }
}

// Jalankan saat halaman dimuat
document.addEventListener('DOMContentLoaded', updateCartBadge);
</script>
@endpush
