let mix = require('laravel-mix');
var tailwindcss = require('tailwindcss');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/access_request_form.js', 'public/js')
    .js('resources/assets/js/digital_setup_form.js', 'public/js')
    .js('resources/assets/js/request_demo_form.js', 'public/js')
    .js('resources/assets/js/request_quote_form.js', 'public/js')
    .browserSync({
        proxy: "127.0.0.1:8000",
        files: [
            "public/js/*.js",
            "public/css/*.css",
            "app/*.*",
            "app/**/*.*",
            "resources/views/**/*.*"
        ]
    });

mix.postCss('resources/assets/css/app.css', 'public/css', [
    tailwindcss('./tailwind.js'),
]);
