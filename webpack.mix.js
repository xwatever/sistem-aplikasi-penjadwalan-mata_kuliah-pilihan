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

mix.setPublicPath('public');
mix.setResourceRoot('../');

// mix.js('resources/js/app.js', 'public/js')
//     .vue()
//     .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', []);

// datatable.js
mix.copy('node_modules/datatables.net-dt', 'public/dist/datatablejs');
mix.copy('node_modules/datatables.net-responsive-dt', 'public/dist/datatablejs');

// vue3 datetimepicker
mix.copy('node_modules/vue3-date-time-picker', 'public/dist/vue3-datetimepicker');

// Enable Ignore node_modules on Watch
mix.override((config) => {
    delete config.watchOptions;
});
