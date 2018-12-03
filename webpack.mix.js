let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
mix.copy('resources/assets/js/vendor', 'public/js/vendor', false);
mix.copy('resources/assets/images', 'public/images', false);
mix.extract(['vue', 'axios', 'bootstrap', 'bootstrap-material-design', 'popper.js', 'lodash', 'simplemde', 'textcomplete']);
mix.version();

if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'source-map'
    })
        .sourceMaps()
}
