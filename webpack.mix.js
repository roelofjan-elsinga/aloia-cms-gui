const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const purgeCss = require('laravel-mix-purgecss');

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
    .setPublicPath('public')
    .sass('resources/assets/sass/style.scss', 'public')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.js') ],
    })
    .purgeCss({
        extensions: ['html', 'js', 'php', 'md'],
    })
    .sourceMaps()
    .version();
