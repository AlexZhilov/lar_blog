const mix = require('laravel-mix');

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

mix
    // SITE
    // lib css
    .styles([
        'resources/public/site/css/font-awesome.min.css',
        'resources/public/site/css/elegant-icons.css',
        'resources/public/site/css/nice-select.css',
        'resources/public/site/css/jquery-ui.min.css',
        'resources/public/site/css/owl.carousel.min.css',
        'resources/public/site/css/slicknav.min.css',

    ],'public/assets/css/libs.css')
    // user scss styles
    .sass('resources/public/site/sass/style.scss', 'public/assets/css')
    // lib js
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'resources/public/site/js/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',

        'resources/public/site/js/jquery.nice-select.min.js',
        'resources/public/site/js/jquery-ui.min.js',
        'resources/public/site/js/jquery.slicknav.js',
        'resources/public/site/js/mixitup.min.js',
        'resources/public/site/js/owl.carousel.min.js',

    ], 'public/assets/js/scripts.js')
    // user js
    .js('resources/public/site/js/main.js', 'public/assets/js')

    .browserSync({
        proxy: 'http://localhost:8000/',
        open: false,
        files: [
            // 'app/**/*',
            // 'public/assets/**/*',
            'public/assets/css/style.css',
            'resources/views/site/*',
        ]
    })
    .sourceMaps();
