const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false,
    theme: {
        extend: {
            colors: {
                orange: colors.orange
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
