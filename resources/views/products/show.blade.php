@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1581044777550-4cfa6ce670c0?q=80&w=600"
                 id="product-image"
                 class="img-fluid rounded shadow"
                 alt="Produk">
        </div>
        <div class="col-md-6">
            <h1 id="product-name">Kemeja Batik "Parang Modern"</h1>
            <p class="text-maroon fw-bold fs-4" id="product-price">Rp 350.000</p>
            <p id="product-desc">Kemeja batik dengan motif parang modern, nyaman dipakai seharian.</p>
            <button class="btn btn-maroon px-4 py-2" onclick="tambahKeKeranjang('P001', 'Kemeja Batik', 350000, 'https://images.unsplash.com/photo-1581044777550-4cfa6ce670c0?q=80&w=600')">
                Tambah ke Keranjang
            </button>
            <a href="{{ route('products.index') }}" class="d-block mt-3">← Kembali ke Produk</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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
