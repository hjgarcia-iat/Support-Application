let mix = require('laravel-mix');
require('laravel-mix-tailwind');

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
    .js('resources/assets/js/return_request.js', 'public/js')
    .js('resources/assets/js/nextgenpet_request.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .version()
    .tailwind()
    .browserSync({
        proxy: "support.activatelearning.test",
        files: [
            "public/js/*.js",
            "public/css/*.css",
            "app/*.*",
            "app/**/*.*",
            "resources/views/**/*.*"
        ]
    });

