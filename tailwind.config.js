import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    ],
    theme: {
    extend: {
        // fontFamily: { sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'] },
    },
    },
    plugins: [require('@tailwindcss/forms')],
};

