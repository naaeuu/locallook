/**
 * Logika khusus untuk halaman /cart
 * Merender item, menambah/mengurangi kuantitas, menghapus item, dan menghitung total.
 */

// Panggil 'updateCartBadge' global yang sudah ada di cart.js
const updateCartBadge = window.updateCartBadge;

/**
 * Merender seluruh isi halaman keranjang.
 */
function renderCart() {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    const itemsDiv = document.getElementById('cart-items-container');
    const summaryDiv = document.getElementById('cart-summary-container');
    const emptyDiv = document.getElementById('empty-cart-message');

    // Cek jika elemen tidak ditemukan, stop eksekusi
    if (!itemsDiv || !summaryDiv || !emptyDiv) {
        return;
    }

    if (cart.length === 0) {
        itemsDiv.innerHTML = '';
        summaryDiv.classList.add('hidden');
        emptyDiv.classList.remove('hidden');
        updateCartBadge();
        return;
    }

    // Ada item, tampilkan
    summaryDiv.classList.remove('hidden');
    emptyDiv.classList.add('hidden');

    let itemsHtml = '';
    let subtotal = 0;

    cart.forEach((item, index) => {
        const itemTotal = item.harga * item.jumlah;
        subtotal += itemTotal;

        // UI BARU UNTUK CART ITEM
        itemsHtml += `
        <div class="cart-item">
            <img src="${item.gambar}" alt="${item.nama}" class="cart-item-image">

            <div class="flex-grow">
                <h3 class="cart-item-title">${item.nama}</h3>
                <span class="cart-item-price">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="quantity-control">
                    <button class="quantity-btn rounded-l-lg" onclick="decreaseQuantity(${index})" ${item.jumlah <= 1 ? 'disabled' : ''}>
                        -
                    </button>
                    <input type="text" class="quantity-input" value="${item.jumlah}" readonly>
                    <button class="quantity-btn rounded-r-lg" onclick="increaseQuantity(${index})">
                        +
                    </button>
                </div>

                <div class="w-32 text-right">
                    <span class="font-semibold text-lg">Rp ${itemTotal.toLocaleString('id-ID')}</span>
                </div>

                <button onclick="removeItem(${index})" class="text-gray-400 hover:text-red-600" title="Hapus item">
                    <i class="fas fa-trash-alt text-lg"></i>
                </button>
            </div>
        </div>
        `;
    });

    itemsDiv.innerHTML = itemsHtml;

    // Render Summary
    const total = subtotal;

    // Cek auth status dari Blade
    const authCheck = document.getElementById('cart-page-data')?.dataset.auth === 'true';
    let checkoutButton;

    // === PERUBAHAN DI SINI ===
    if (authCheck) {
        // Jika sudah login, arahkan ke halaman 'pilih alamat'
        checkoutButton = `
            <button class="btn-maroon w-full mt-6" onclick="window.location.href='/checkout/address'">
                Lanjut ke Alamat
            </button>
        `;
    } else {
        // Jika belum login, arahkan ke halaman login
        checkoutButton = `
            <button class="btn-maroon w-full mt-6" onclick="window.location.href='/login'">
                Lanjut ke Alamat
            </button>
        `;
    }
    // === AKHIR PERUBAHAN ===

    summaryDiv.innerHTML = `
        <h2 class="font-heading text-2xl font-bold text-maroon mb-4">Ringkasan</h2>
        <div class="space-y-3">
            <div class="flex justify-between text-lg">
                <span>Subtotal</span>
                <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
            </div>
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex justify-between text-xl font-bold text-maroon">
                    <span>Total</span>
                    <span>Rp ${total.toLocaleString('id-ID')}</span>
                </div>
            </div>
        </div>
        ${checkoutButton}
    `;

    updateCartBadge();
}

/**
 * Menambah kuantitas item
 */
function increaseQuantity(index) {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    if (cart[index]) {
        cart[index].jumlah++;
        localStorage.setItem('keranjang', JSON.stringify(cart));
        renderCart();
    }
}

/**
 * Mengurangi kuantitas item
 */
function decreaseQuantity(index) {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    if (cart[index] && cart[index].jumlah > 1) {
        cart[index].jumlah--;
        localStorage.setItem('keranjang', JSON.stringify(cart));
        renderCart();
    } else {
        removeItem(index);
    }
}

/**
 * Menghapus item dari keranjang
 */
function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('keranjang')) || [];
    cart.splice(index, 1);
    localStorage.setItem('keranjang', JSON.stringify(cart));
    renderCart();
}

// Kita tidak butuh submitCheckout() lagi di file ini
// window.submitCheckout = submitCheckout;

// Ekpos fungsi ke global scope
window.removeItem = removeItem;
window.increaseQuantity = increaseQuantity;
window.decreaseQuantity = decreaseQuantity;

// Jalankan renderCart() saat halaman dimuat
document.addEventListener('DOMContentLoaded', renderCart);
