/**
 * Menginisialisasi fungsionalitas filter di halaman /products.
 * Hanya berjalan jika menemukan elemen filter di halaman.
 */
function initializeProductFilter() {
    // Tombol filter
    const filterButtons = document.querySelectorAll('[data-category-filter]');
    // Card produk
    const productCards = document.querySelectorAll('[data-category-product]');

    // Jika tidak ada elemen filter di halaman ini, hentikan eksekusi.
    if (filterButtons.length === 0 || productCards.length === 0) {
        return;
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Hapus 'active' dari semua tombol
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Tambahkan 'active' ke tombol yang diklik
            button.classList.add('active');

            const selectedCategory = button.dataset.categoryFilter;

            productCards.forEach(cardWrapper => {
                const cardCategories = cardWrapper.dataset.categoryProduct.split(' ');

                // Tampilkan jika 'Semua' ATAU kategori produk ada dalam list
                if (selectedCategory === 'all' || cardCategories.includes(selectedCategory)) {
                    cardWrapper.style.display = 'block';
                } else {
                    cardWrapper.style.display = 'none';
                }
            });
        });
    });
}

// Jalankan fungsi ini saat DOM selesai dimuat
document.addEventListener('DOMContentLoaded', initializeProductFilter);
