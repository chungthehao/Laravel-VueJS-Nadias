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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

// https://laravel.com/docs/5.8/mix#versioning-and-cache-busting
// - Tu kem theo unique query string de buoc browser ng dung tren production
// lay dung version moi cua file css js (link tao bang mix helper)
if (mix.inProduction()) {
    mix.version();
}

// https://laravel.com/docs/5.8/mix#browsersync-reloading
// Tu refresh khi css, js (duoc compile bang mix) hay php files thay doi
mix.browserSync('dev.nadias');
