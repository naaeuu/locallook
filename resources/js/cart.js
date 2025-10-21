// resources/js/cart.js

// ... (fungsi updateCartBadge, dll) ...

function tambahKeKeranjang(id, nama, harga, gambar) {
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];
    let produkAda = keranjang.find(p => p.id === id);

    if (produkAda) {
        produkAda.jumlah++;
    } else {
        keranjang.push({ id, nama, harga, gambar, jumlah: 1 });
    }
    localStorage.setItem('keranjang', JSON.stringify(keranjang));
    alert(`"${nama}" telah ditambahkan ke keranjang.`);

    // Panggil fungsi badge global
    updateCartBadge(); 
}

// <-- TAMBAHKAN INI -->
// Ekpos fungsi ke global scope agar onclick="" di Blade bisa menemukannya
window.tambahKeKeranjang = tambahKeKeranjang;

// Panggil fungsi yang harus jalan saat halaman dimuat
document.addEventListener("DOMContentLoaded", function() {
    updateCartBadge();

    // Cek jika kita di halaman detail
    if (document.getElementById('product-detail-name')) {
        loadProductDetail();
    }

    // Cek jika kita di halaman keranjang
    if (document.getElementById('cart-items-container')) {
        tampilkanKeranjang();
    }
});

// ... (sisa fungsi Anda: loadProductDetail, tampilkanKeranjang, dll) ...