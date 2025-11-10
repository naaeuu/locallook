{{--
  Versi Refactor ke Tailwind V4.
  - Menghapus class .footer dan .social-icons
  - Menggunakan utility classes:
    - bg-maroon, text-white (dari config)
    - py-12 (padding atas/bawah)
    - container, mx-auto, text-center (centering)
    - flex, justify-center, space-x-6 (untuk ikon)
    - hover:text-nude (efek hover dari config)
--}}
<footer class="bg-maroon text-white py-12" role="contentinfo">
    <div class="container mx-auto px-4 text-center">

        <div class="flex justify-center space-x-6 mb-6" role="list" aria-label="Ikuti kami di media sosial">

            <a href="#" aria-label="Instagram Local Look" role="listitem"
                class="text-3xl text-white transition-colors duration-300 hover:text-nude">
                <i class="fab fa-instagram"></i>
            </a>

            <a href="#" aria-label="Facebook Local Look" role="listitem"
                class="text-3xl text-white transition-colors duration-300 hover:text-nude">
                <i class="fab fa-facebook-f"></i>
            </a>

            <a href="#" aria-label="TikTok Local Look" role="listitem"
                class="text-3xl text-white transition-colors duration-300 hover:text-nude">
                <i class="fab fa-tiktok"></i>
            </a>

            <a href="#" aria-label="WhatsApp Local Look" role="listitem"
                class="text-3xl text-white transition-colors duration-300 hover:text-nude">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>

        <p class="text-base">&copy; 2025 Local Look. All rights reserved.</p>
    </div>
</footer>
