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
                sans: ['Kalpurush', 'Noto Sans Bengali', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#f0f7ff',
                    100: '#e0effe',
                    200: '#bfe0fe',
                    300: '#8ecbfc',
                    400: '#52aff8',
                    500: '#2593f2',
                    600: '#0c73db', // Vibrant Academic Blue
                    700: '#0b5cb5', // Royal Blue
                    800: '#0e4a90', // Deep Academic Navy
                    900: '#0c3c74', // Prestigious Emblem Navy
                    950: '#072449', // Midnight Navy for Footers & Headers
                },
                accent: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706', // Academic Gold/Amber
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                // Harmonize legacy indigo references with the brand palette so no purple clash remains
                indigo: {
                    50: '#f0f7ff',
                    100: '#e0effe',
                    200: '#bfe0fe',
                    300: '#8ecbfc',
                    400: '#52aff8',
                    500: '#2593f2',
                    600: '#0c73db',
                    700: '#0b5cb5',
                    800: '#0e4a90',
                    900: '#0c3c74',
                    950: '#072449',
                },
            },
        },
    },

    plugins: [forms],
};
