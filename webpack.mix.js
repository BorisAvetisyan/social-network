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
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
