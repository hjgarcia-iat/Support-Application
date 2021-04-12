const colors = require("tailwindcss/colors");

module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: false,
    theme: {
        fontFamily: {
            'sans': ['Nunito', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        },
        extend: {
            spacing: {
                "100": "27rem",
            },
            colors: {
                lightBlue: colors.lightBlue,
                orange: colors.orange,
                blue: {
                    brand: "#0061AA",
                    "brand-medium": "#004779",
                    "brand-light": "#4498d0",
                    "brand-dark": "#002e42",
                },
            },
        },
    },
    variants: {},
    plugins: [],
};
