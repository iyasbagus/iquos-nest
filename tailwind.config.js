import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                "fade-in-out": {
                    "0%": { opacity: "0", transform: "translateY(-10px) scale(0.95)" },
                    "10%": { opacity: "1", transform: "translateY(0) scale(1)" },
                    "90%": { opacity: "1", transform: "translateY(0) scale(1)" },
                    "100%": { opacity: "0", transform: "translateY(-10px) scale(0.95)" },
                },
            },
            animation: {
                "fade-in-out": "fade-in-out 3s ease-in-out",
            },
        },
    },

    plugins: [forms],
};
