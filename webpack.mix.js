const mix = require('laravel-mix');
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
        postCss: [ require('tailwindcss')('./tailwind.config.js') ],
    })
    .purgeCss({
        extensions: ['html', 'js', 'php', 'md'],
        folders: ['views'],
    })
    .sourceMaps()
    .version();
