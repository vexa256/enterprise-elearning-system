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

mix.js('resources/js/app.js', 'public/js')
    .js('assets/app.js', 'public/js/Pretest.js')
    .js('assets/PostTest.js', 'public/js/PostTest.js')
    .js('assets/ModularTest.js', 'public/js/ModularTest.js')
    .js('assets/PracticalTest.js', 'public/js/PracticalTest.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);
