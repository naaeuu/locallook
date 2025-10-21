@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="container py-5">
    <h2>Keranjang Belanja</h2>
    <div id="cart-items"></div>
    <div id="empty-cart" class="text-center py-5 d-none">
        <p>Keranjang Anda kosong.</p>
        <a href="{{ route('products.index') }}" class="btn btn-maroon">Belanja Sekarang</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
function renderCart() {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    const itemsDiv = document.getElementById('cart-items');
    const emptyDiv = document.getElementById('empty-cart');

    if (cart.length === 0) {
        itemsDiv.innerHTML = '';
        emptyDiv.classList.remove('d-none');
        return;
    }

    emptyDiv.classList.add('d-none');
    let html = '<div class="row">';
    cart.forEach((item, index) => {
        html += `
        <div class="col-12 mb-3 p-3 border rounded">
            <div class="d-flex align-items-center">
                <img src="${item.gambar}" width="80" class="rounded me-3">
                <div>
                    <h5>${item.nama}</h5>
                    <p class="text-maroon">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                </div>
                <div class="ms-auto">
                    <button class="btn btn-sm btn-outline-danger" onclick="removeItem(${index})">Hapus</button>
                </div>
            </div>
        </div>
        `;
    });
    html += '</div>';
    itemsDiv.innerHTML = html;
    updateCartBadge();
}

function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    cart.splice(index, 1);
    localStorage.setItem('keranjang', JSON.stringify(cart));
    renderCart();
}

function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    const total = cart.reduce((sum, item) => sum + (item.jumlah || 0), 0);
    const badge = document.getElementById('cart-badge');
    if (badge) {
        badge.textContent = total;
        badge.classList.toggle('d-none', total === 0);
    }
}

document.addEventListener('DOMContentLoaded', renderCart);
</script>
@endpush
