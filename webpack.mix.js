const mix = require('laravel-mix');

const resources_site = 'resources/public/site';
const resources_admin = 'resources/public/admin';
const public_dir = 'public/assets';
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

// *** SITE ***
mix
    // lib css
    .styles([
        `${resources_site}/css/font-awesome.min.css`,
        `${resources_site}/css/elegant-icons.css`,
        `${resources_site}/css/nice-select.css`,
        `${resources_site}/css/jquery-ui.min.css`,
        `${resources_site}/css/owl.carousel.min.css`,
        `${resources_site}/css/slicknav.min.css`,

    ],`${public_dir}/css/libs.css`)
    // user scss styles
    .sass(`${resources_site}/sass/style.scss`, `${public_dir}/css`)
    // lib js
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        `${resources_site}/js/popper.min.js`,
        'node_modules/bootstrap/dist/js/bootstrap.js',

        `${resources_site}/js/jquery.nice-select.min.js`,
        `${resources_site}/js/jquery-ui.min.js`,
        `${resources_site}/js/jquery.slicknav.js`,
        `${resources_site}/js/mixitup.min.js`,
        `${resources_site}/js/owl.carousel.min.js`,

    ], `${public_dir}/js/libs.js`)
    // user js
    .js(`${resources_site}/js/main.js`, `${public_dir}/js`);

// *** ADMIN ***
mix
    // user scss styles
    .sass(`${resources_admin}/sass/style.scss`, `${public_dir}/admin/css`)
    .scripts([
        `${resources_admin}/js/bs-custom-file-input.min.js`,
    ],`${public_dir}/admin/js/libs.js`)
    // user js
    .js(`${resources_admin}/js/main.js`, `${public_dir}/admin/js`);


mix
    .browserSync({
        proxy: 'http://localhost:8000/',
        open: false,
        files: [
            //*** views ***
            'resources/views/**/*',
            // *** site ***
            `${public_dir}/css/style.css`,
            `${public_dir}/js/main.js`,
            // *** admin ***
            `${public_dir}/admin/css/style.css`,
            `${public_dir}/admin/js/main.js`,
        ]
    })
    .sourceMaps();
