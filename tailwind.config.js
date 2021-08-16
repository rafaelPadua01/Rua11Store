const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus'],
        tableLayout: ['responsive', 'hover', 'focus'],
        borderCollapse: ['responsive', 'hover', 'focus'],
        objectFit: ['responsive', 'hover', 'focus'],
        fontSize: ['hover', 'focus'],
    },

    plugins: [require('@tailwindcss/ui'),
        //require('tailwindcss-plugins/pagination')({
            /*customizações aqui */
        //})
    ],
};
