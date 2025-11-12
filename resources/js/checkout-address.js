/**
 * Logika untuk halaman Checkout Address.
 * Hanya berjalan jika menemukan div#cart-page-data.
 */
document.addEventListener('DOMContentLoaded', function() {
    // 1. Temukan elemen data. Jika tidak ada, kita tidak di halaman yang benar.
    const pageData = document.getElementById('cart-page-data');
    if (!pageData) {
        return; // Stop eksekusi jika ini bukan halaman checkout
    }

    // 2. Ambil data penting dari atribut data-*
    const cartData = localStorage.getItem('keranjang');
    const payButton = document.getElementById('pay-button');
    const errorAlert = document.getElementById('js-error-alert');

    // Ambil data yang di-passing dari Blade
    const PAY_ROUTE = pageData.dataset.payRoute;
    const HOME_ROUTE = pageData.dataset.homeRoute;

    // 3. Masukkan data keranjang ke form
    if (cartData) {
        document.getElementById('checkout-cart-data').value = cartData;
    } else {
        // Jika keranjang kosong, nonaktifkan tombol submit
        payButton.disabled = true;
        payButton.innerHTML = "Keranjang Kosong";
        payButton.classList.add('opacity-50', 'cursor-not-allowed');
    }

    // 4. Tambahkan event listener ke tombol "Bayar Sekarang"
    payButton.addEventListener('click', async function(e) {
        e.preventDefault();
        payButton.disabled = true;
        payButton.innerHTML = "Memproses...";
        errorAlert.classList.add('hidden');

        // Ambil data form (termasuk _token, address_id, dan cart)
        const form = document.getElementById('checkout-form');
        const formData = new FormData(form);

        try {
            // 5. Kirim data ke backend (menggunakan URL dari data-attribute)
            const response = await fetch(PAY_ROUTE, {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    // Kita tidak perlu header 'X-CSRF-TOKEN' karena
                    // 'formData' sudah mengandung field '_token' dari Blade @csrf
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                // Jika server mengembalikan error (validasi stok, dll)
                throw new Error(data.error || 'Terjadi kesalahan.');
            }

            // 6. Jika sukses dapat token, panggil Snap.js
            window.snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    /* Pembayaran sukses */
                    console.log(result);
                    alert("Pembayaran berhasil!");
                    localStorage.removeItem('keranjang');
                    // Redirect ke homepage (menggunakan URL dari data-attribute)
                    window.location.href = HOME_ROUTE + '?status=success';
                },
                onPending: function(result) {
                    /* Pembayaran pending */
                    console.log(result);
                    alert("Menunggu pembayaran Anda...");
                    localStorage.removeItem('keranjang');
                    window.location.href = HOME_ROUTE + '?status=pending';
                },
                onError: function(result) {
                    /* Pembayaran error */
                    console.log(result);
                    alert("Pembayaran Gagal.");
                    payButton.disabled = false;
                    payButton.innerHTML = "Bayar Sekarang";
                },
                onClose: function() {
                    /* Pop-up ditutup tanpa bayar */
                    alert('Anda menutup pop-up pembayaran.');
                    payButton.disabled = false;
                    payButton.innerHTML = "Bayar Sekarang";
                }
            });

        } catch (error) {
            // Tampilkan error jika fetch gagal
            console.error(error);
            errorAlert.innerHTML = error.message;
            errorAlert.classList.remove('hidden');
            payButton.disabled = false;
            payButton.innerHTML = "Bayar Sekarang";
        }
    });
});
