const mix = require('laravel-mix');
const autoPreprocess = require('svelte-preprocess');
require('laravel-mix-svelte');

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

mix.ts('resources/js/app.ts', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .svelte({
        dev: !mix.inProduction(),
        preprocess: autoPreprocess()
    })
    .webpackConfig({
        output: {chunkFilename: 'js/[name].js?id=[chunkhash]'},
    })
    .version();