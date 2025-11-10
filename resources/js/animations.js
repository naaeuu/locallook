/**
 * Meng-handle animasi fade-in saat elemen masuk ke viewport.
 */
function handleScrollAnimations() {
    document.querySelectorAll('.fade-in').forEach(el => {
        const rect = el.getBoundingClientRect();

        // Tampil jika elemen 100px dari bawah viewport
        if (rect.top < window.innerHeight - 100 && rect.bottom > 0) {
            const delay = el.style.getPropertyValue('--delay') || '0s';
            el.style.transitionDelay = delay;
            el.classList.add('visible');
        } else {
            // Sembunyikan lagi jika keluar viewport (untuk animasi ulang)
            el.classList.remove('visible');
        }
    });
}

// Jalankan saat pertama kali load dan setiap kali scroll
document.addEventListener('DOMContentLoaded', handleScrollAnimations);
window.addEventListener('scroll', handleScrollAnimations);
