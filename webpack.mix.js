const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy('node_modules/jquery', 'public/js/jquery')
    .copy('node_modules/bootstrap', 'public/lib/bootstrap')
    .copy('node_modules/sticky-js', 'public/lib/sticky-js')
    .copy('node_modules/js-cookie', 'public/lib/js-cookie')
    .copy('node_modules/block-ui', 'public/lib/block-ui')
    .copy('node_modules/bootstrap-select', 'public/lib/bootstrap-select')
    .copy('node_modules/popper.js', 'public/lib/popper.js')
    .copy('node_modules/select2', 'public/lib/select2')
    .copy('node_modules/perfect-scrollbar', 'public/lib/perfect-scrollbar')
    .copy('node_modules/line-awesome', 'public/lib/line-awesome')
    .copy('node_modules/font-awesome', 'public/lib/font-awesome')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
