import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: colors.cyan,
                'gradient-start': '#a8edea',
                'gradient-end': '#fed6e3',
                'neo-yellow': '#FFDE59',
                'neo-blue': '#5454D4',
                'neo-purple': '#A259FF',
                'neo-green': '#00C6AE',
                'neo-black': '#1B1B1B',
                'neo-white': '#F5F5F5',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', 'Fira Code', ...defaultTheme.fontFamily.mono],
            },
            boxShadow: {
                'neo': '5px 5px 0px 0px #000000',
                'neo-sm': '3px 3px 0px 0px #000000',
                'neo-lg': '8px 8px 0px 0px #000000',
                'neo-hover': '2px 2px 0px 0px #000000',
            },
        },
    },

    plugins: [forms],
};
