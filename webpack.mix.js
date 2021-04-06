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

mix.js('resources/assets/js/access_request_form.js', 'public/js').vue({ version: 2 })
mix.js('resources/assets/js/contact_request.js', 'public/js').vue({ version: 2 })
    .js('resources/assets/js/digital_setup_form.js', 'public/js').vue({ version: 2 })
    .js('resources/assets/js/return_request.js', 'public/js').vue({ version: 2 })
    .js('resources/assets/js/calculator.js', 'public/js').vue({ version: 2 })
    .js('resources/assets/js/request_product_info.js', 'public/js').vue({ version: 2 })
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ])
    .version()
    .disableNotifications()
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

