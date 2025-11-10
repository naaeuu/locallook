/**
 * BARU: Merender pop-up keranjang di navbar.
 * Dipanggil setiap kali keranjang berubah.
 */
function renderCartHover() {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    const container = document.getElementById('cart-hover-content');

    // Jika container-nya tidak ada di halaman ini, jangan lakukan apa-apa
    if (!container) {
        return;
    }

    // Jika keranjang kosong, tampilkan pesan
    if (cart.length === 0) {
        container.innerHTML = `
            <div class="p-6 text-center">
                <i class="fas fa-shopping-basket text-5xl text-gray-300 mb-4"></i>
                <h3 class="font-semibold text-black mb-1">Wah, keranjang belanjamu kosong</h3>
                <p class="text-sm text-gray-500 mb-4">Yuk, isi dengan barang-barang impianmu!</p>
                <a href="/products" class="btn-maroon py-2 px-4 text-sm">
                    Mulai Belanja
                </a>
            </div>
        `;
    } else {
        // Jika ada isi, tampilkan item (maksimal 3)
        let itemsHtml = '<div class="p-4 space-y-3">';

        cart.slice(0, 3).forEach(item => {
            itemsHtml += `
                <div class="flex gap-3">
                    <img src="${item.gambar}" alt="${item.nama}" class="w-16 h-16 object-cover rounded">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-black truncate">${item.nama}</p>
                        <p class="text-sm text-gray-500">${item.jumlah} x Rp ${parseInt(item.harga).toLocaleString('id-ID')}</p>
                    </div>
                </div>
            `;
        });

        // Tampilkan pesan jika item lebih dari 3
        if (cart.length > 3) {
            itemsHtml += `<p class="text-sm text-center text-gray-500">+ ${cart.length - 3} produk lainnya...</p>`;
        }

        itemsHtml += '</div>';

        // Tambahkan footer dengan tombol "Lihat Keranjang"
        itemsHtml += `
            <div class="border-t border-gray-100 p-4 bg-gray-50 rounded-b-lg">
                <a href="/cart" class="btn-maroon w-full text-center py-2 text-sm">
                    Lihat Keranjang
                </a>
            </div>
        `;
        container.innerHTML = itemsHtml;
    }
}

/**
 * Mengupdate badge keranjang di Navbar (desktop dan mobile).
 * Menggunakan class '.cart-badge' dan Tailwind class 'hidden'.
 */
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    const badges = document.querySelectorAll('.cart-badge');
    const total = cart.reduce((sum, item) => sum + (item.jumlah || 0), 0);

    badges.forEach(badge => {
        if (total > 0) {
            badge.textContent = total;
            badge.classList.remove('hidden'); // Tailwind class
        } else {
            badge.classList.add('hidden'); // Tailwind class
        }
    });

    // UPDATE: Panggil renderCartHover() setiap kali badge di-update
    renderCartHover();
}

/**
 * Menambahkan item ke keranjang (localStorage).
 * Dipanggil dari tombol 'onclick' di Blade.
 */
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

    // Panggil update badge (yang juga akan memanggil renderCartHover)
    updateCartBadge();
}

// --- Ekspor ke Global Scope ---
window.tambahKeKeranjang = tambahKeKeranjang;
window.updateCartBadge = updateCartBadge;

// --- Inisialisasi ---
// UPDATE: Jalankan update badge saat halaman dimuat
// Ini akan otomatis menjalankan renderCartHover() juga
document.addEventListener('DOMContentLoaded', updateCartBadge);
