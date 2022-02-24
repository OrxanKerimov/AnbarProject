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
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);


mix.styles([ // объяденинение и перенос всех css файлов для страницы логина
    'resources/anbar/assets/login/vendor/bootstrap/css/bootstrap.min.css',
    'resources/anbar/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
    'resources/anbar/assets/login/vendor/animate/animate.css',
    'resources/anbar/assets/login/vendor/css-hamburgers/hamburgers.min.css',
    'resources/anbar/assets/login/vendor/select2/select2.min.css',
    'resources/anbar/assets/login/css/util.css',
    'resources/anbar/assets/login/css/main.css',
],'public/assets/user/login/css/login.css');

mix.scripts([ // Объяденение и перенос всех js файлов для страницы логина
    'resources/anbar/assets/login/vendor/jquery/jquery-3.2.1.min.js',
    'resources/anbar/assets/login/vendor/bootstrap/js/popper.js',
    'resources/anbar/assets/login/vendor/bootstrap/js/bootstrap.min.js',
    'resources/anbar/assets/login/vendor/select2/select2.min.js',
    'resources/anbar/assets/login/vendor/tilt/tilt.jquery.min.js',
    'resources/anbar/assets/login/js/main.js',
],'public/assets/user/login/js/login.js');

mix.styles([ // Объяденение и перенос всех css файлов для страницы регистрации
    'resources/anbar/assets/register/vendor/bootstrap/css/bootstrap.min.css',
    'resources/anbar/assets/register/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
    'resources/anbar/assets/register/fonts/Linearicons-Free-v1.0.0/icon-font.min.css',
    'resources/anbar/assets/register/fonts/iconic/css/material-design-iconic-font.min.css',
    'resources/anbar/assets/register/vendor/animate/animate.css',
    'resources/anbar/assets/register/vendor/css-hamburgers/hamburgers.min.css',
    'resources/anbar/assets/register/vendor/animsition/css/animsition.min.css',
    'resources/anbar/assets/register/vendor/select2/select2.min.css',
    'resources/anbar/assets/register/vendor/daterangepicker/daterangepicker.css',
    'resources/anbar/assets/register/css/util.css',
    'resources/anbar/assets/register/css/main.css',
],'public/assets/user/register/css/register.css');

mix.scripts([ // Объяденение и перенос всех js файлов для страницы регистрации
    'resources/anbar/assets/register/vendor/jquery/jquery-3.2.1.min.js',
    'resources/anbar/assets/register/vendor/animsition/js/animsition.min.js',
    'resources/anbar/assets/register/vendor/bootstrap/js/popper.js',
    'resources/anbar/assets/register/vendor/bootstrap/js/bootstrap.min.js',
    'resources/anbar/assets/register/vendor/select2/select2.min.js',
    'resources/anbar/assets/register/vendor/daterangepicker/moment.min.js',
    'resources/anbar/assets/register/vendor/daterangepicker/daterangepicker.js',
    'resources/anbar/assets/register/vendor/countdowntime/countdowntime.js',
    'resources/anbar/assets/register/js/main.js',
],'public/assets/user/register/js/register.js');

mix.styles([ // Объяденение и перенос всех сss файлов для главной страницы
    'resources/anbar/assets/index/plugins/fontawesome-free/css/all.min.css',
    'resources/anbar/assets/index/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
    'resources/anbar/assets/index/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
    'resources/anbar/assets/index/plugins/jqvmap/jqvmap.min.css',
    'resources/anbar/assets/index/dist/css/adminlte.min.css',
    'resources/anbar/assets/index/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
    'resources/anbar/assets/index/plugins/daterangepicker/daterangepicker.css',
    'resources/anbar/assets/index/plugins/summernote/summernote-bs4.css',
],'public/assets/main/index/css/index.css');

mix.scripts([ // Объяденение и перенос всех js файлов для главной страницы
    'resources/anbar/assets/index/plugins/jquery/jquery.min.js',
    'resources/anbar/assets/index/plugins/jquery-ui/jquery-ui.min.js',
    'resources/anbar/assets/index/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/anbar/assets/index/plugins/chart.js/Chart.min.js',
    'resources/anbar/assets/index/plugins/sparklines/sparkline.js',
    'resources/anbar/assets/index/plugins/jqvmap/jquery.vmap.min.js',
    'resources/anbar/assets/index/plugins/jqvmap/maps/jquery.vmap.usa.js',
    'resources/anbar/assets/index/plugins/jquery-knob/jquery.knob.min.js',
    'resources/anbar/assets/index/plugins/moment/moment.min.js',
    'resources/anbar/assets/index/plugins/daterangepicker/daterangepicker.js',
    'resources/anbar/assets/index/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
    'resources/anbar/assets/index/plugins/summernote/summernote-bs4.min.js',
    'resources/anbar/assets/index/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
    'resources/anbar/assets/index/dist/js/adminlte.js',
    'resources/anbar/assets/index/dist/js/pages/dashboard.js',
    'resources/anbar/assets/index/dist/js/demo.js',
],'public/assets/main/index/js/index.js');

mix.scripts([ // Объяденение и перенос всех js файлов для таблиц содержащих базы данных
    'resources/anbar/assets/index/plugins/datatables/jquery.dataTables.min.js',
    'resources/anbar/assets/index/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
    'resources/anbar/assets/index/plugins/datatables-responsive/js/dataTables.responsive.min.js',
    'resources/anbar/assets/index/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
    'resources/anbar/assets/index/plugins/datatables-buttons/js/dataTables.buttons.min.js',
    'resources/anbar/assets/index/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
    'resources/anbar/assets/index/plugins/jszip/jszip.min.js',
    'resources/anbar/assets/index/plugins/pdfmake/pdfmake.min.js',
    'resources/anbar/assets/index/plugins/pdfmake/vfs_fonts.js',
    'resources/anbar/assets/index/plugins/datatables-buttons/js/buttons.html5.min.js',
    'resources/anbar/assets/index/plugins/datatables-buttons/js/buttons.print.min.js',
    'resources/anbar/assets/index/plugins/datatables-buttons/js/buttons.colVis.min.js',
],'public/assets/main/index/js/database.js');

mix.styles([ // Объяденение и перенос всех css файлов для таблиц содержащих базы данных
    'resources/anbar/assets/index/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
    'resources/anbar/assets/index/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
    'resources/anbar/assets/index/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
],'public/assets/main/index/css/database.css');


mix.copyDirectory('resources/anbar/assets/index/plugins/fontawesome-free/webfonts','public/assets/main/index/webfonts'); // Перенос папки со шрифтами для главной страницы
mix.copyDirectory('resources/anbar/assets/index/dist/img','public/assets/main/index/img'); // Перенос папки с фотографиями для главной страницы
mix.copyDirectory('resources/anbar/assets/index/docs','public/assets/main/index/docs'); // Перенос папки с файлами для главной страницы
mix.copyDirectory('resources/anbar/assets/index/build','public/assets/main/index/build');
mix.copyDirectory('resources/anbar/assets/login/images','public/assets/user/login/images'); // Перенос папки с фотографиями для страницы логина
mix.copyDirectory('resources/anbar/assets/login/fonts','public/assets/user/login/fonts'); // Перенос папки со шрифтами для страницы логина
mix.copyDirectory('resources/anbar/assets/register/images','public/assets/user/register/images'); // Перенос папки с фотографиями для страницы регистрации
mix.copyDirectory('resources/anbar/assets/register/fonts','public/assets/user/register/fonts'); // Перенос папки со шрифтами для страницы регистрации




