const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')
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
mix.js('resources/assets/js/contact_request.js', 'public/js')
    .js('resources/assets/js/digital_setup_form.js', 'public/js')
    .js('resources/assets/js/return_request.js', 'public/js')
    .js('resources/assets/js/nextgenpet_request.js', 'public/js')
    .js('resources/assets/js/student_request.js', 'public/js')
    .js('resources/assets/js/remote_learning_request.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('tailwind.js')],
    })
    .version()
    .browserSync({
        proxy: "http://support.activatelearning.local",
        files: [
            "public/js/*.js",
            "public/css/*.css",
            "app/*.*",
            "app/**/*.*",
            "resources/views/**/*.*"
        ]
    });

