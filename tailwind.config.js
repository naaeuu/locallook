import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            // KUSTOMISASI LOKALOOK KITA
            colors: {
                'maroon': {
                    DEFAULT: '#800000',
                    'dark': '#550000',
                },
                'nude': '#f5e9e2',
                'black': '#1a1a1a',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                heading: ['Playfair Display', 'serif'],
                body: ['Montserrat', 'sans-serif'],
            },
        },
    },

    plugins: [forms], // Plugin ini dari Breeze
};
