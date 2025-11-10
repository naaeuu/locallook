export default {
    plugins: {
        tailwindcss: {
            // Tambahkan baris ini untuk 'memaksa' PostCSS
            // membaca file konfigurasi Anda
            config: './tailwind.config.js',
        },
        autoprefixer: {},
    },
};
