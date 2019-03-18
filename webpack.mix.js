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

mix.scripts([
    'resources/assets/theme/js/jquery/dist/jquery.min.js',
    'resources/assets/theme/js/tether/dist/js/tether.min.js',
    'resources/assets/theme/js/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/theme/js/Waves/dist/waves.min.js',
    'resources/assets/theme/js/jquery.scrollbar/jquery.scrollbar.min.js',
    'resources/assets/theme/js/jquery-scrollLock/jquery-scrollLock.min.js',
    'resources/assets/theme/js/Waves/dist/waves.min.js',
    'resources/assets/theme/js/flot/jquery.flot.js',
    'resources/assets/theme/js/flot/jquery.flot.resize.js',
    'resources/assets/theme/js/flot.curvedlines/curvedLines.js',
    'resources/assets/theme/js/jqvmap/dist/jquery.vmap.min.js',
    'resources/assets/theme/js/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js',
    'resources/assets/theme/js/jqvmap/dist/maps/jquery.vmap.world.js',
    'resources/assets/theme/js/salvattore/dist/salvattore.min.js',
    'resources/assets/theme/js/jquery.sparkline/jquery.sparkline.min.js',
    'resources/assets/theme/js/moment/min/moment.min.js',
    'resources/assets/theme/js/fullcalendar/dist/fullcalendar.min.js',
    'resources/assets/theme/js/select2/dist/js/select2.full.min.js',
    'resources/assets/theme/js/flatpickr/dist/flatpickr.min.js',
    'resources/assets/theme/js/jquery.scrollbar/jquery.scrollbar.min.js',
    'resources/assets/theme/js/jquery-scrollLock/jquery-scrollLock.min.js',
    'resources/assets/theme/js/lightgallery/dist/js/lightgallery.min.js',
    'resources/assets/theme/js/lightgallery/demo/js/lg-fullscreen.min.js',
    'resources/assets/theme/js/lightgallery/demo/js/lg-thumbnail.min.js',
    'resources/assets/theme/js/lightgallery/demo/js/lg-zoom.min.js',
    'resources/assets/theme/js/lightgallery/demo/js/lg-video.min.js',
    'resources/assets/theme/js/sweetalert2/dist/sweetalert2.min.js',
    'resources/assets/theme/js/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js',
    'resources/assets/theme/js/nouislider/distribute/nouislider.min.js',
    'resources/assets/theme/js/jquery.richtext/jquery.richtext.min.js',
    'resources/assets/theme/custom_js/actions.js',
    'resources/assets/theme/custom_js/functions/app.js',
    'resources/assets/theme/custom_js/functions/vendors.js'
], 'public/js/all.js')
.styles([
    'resources/assets/theme/js/material-design-iconic-font/dist/css/material-design-iconic-font.min.css',
    'resources/assets/theme/js/animate.css/animate.min.css',
    'resources/assets/theme/js/jquery.scrollbar/jquery.scrollbar.css',
    'resources/assets/theme/js/fullcalendar/dist/fullcalendar.min.css',
    'resources/assets/theme/js/select2/dist/css/select2.min.css',
    'resources/assets/theme/js/flatpickr/dist/flatpickr.min.css',
    'resources/assets/theme/js/jquery.scrollbar/jquery.scrollbar.css',
    'resources/assets/theme/js/lightgallery/dist/css/lightgallery.min.css',
    'resources/assets/theme/js/sweetalert2/dist/sweetalert2.min.css',
    'resources/assets/theme/js/nouislider/distribute/nouislider.min.css',
    'resources/assets/theme/js/jquery.richtext/richtext.min.css',
    'resources/assets/theme/css/app.css',
    'resources/assets/theme/css/custom.css'
], 'public/css/all.css');
//.sass('resources/assets/sass/app.scss', 'public/css')