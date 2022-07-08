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
mix.setPublicPath('public_html/');

/*mix.options({
    hmrOptions: {
        port: 3000
    }
});*/

mix.js('resources/js/app.js', 'js').version()
    .sass('resources/sass/app.scss', 'css').version();
