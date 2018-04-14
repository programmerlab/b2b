var elixir = require('laravel-elixir');
elixir.config.assetsPath = 'bower_components';
elixir.config.publicPath = 'render';
elixir.config.sourcemaps = true;
elixir.config.viewPath   = 'views';

/*
 | Global ayarlar
 */
var config = {
    directory     : "bower_components/",
    buildAssetPath: "render/build/assets/",
    assetPath     : "render/assets/",
    cssPath       : "render/assets/css/",
    cssBuildPath  : "render/build/css/",
    jsPath        : "render/assets/js/",
    jsBuildPath   : "render/build/js/"
};
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir(function(mix) {

    mix.copy('assets', config.directory + 'gokyuzu');

    mix
        .styles([
            'angular/angular-csp.css',
            'datetimepicker/jquery.datetimepicker.css',
            'pace/themes/red/pace-theme-minimal.css',
            'toastr/toastr.min.css',
            'semantic-ui/dist/semantic.min.css',
            'fontawesome/css/font-awesome.min.css'
        ], config.cssPath+'admin.min.css', config.directory)
        .copy(config.directory+'semantic-ui/dist/themes', config.cssPath+'themes')
        .copy(config.directory+'fontawesome/fonts', config.assetPath+'fonts')
        .scripts([
            'angular/angular.min.js',
            'jquery/dist/jquery.min.js',
            'is_js/is.min.js',
            'moment/min/moment.min.js',
            'accounting.js/accounting.min.js',
            'semantic-ui/dist/semantic.min.js',
            'jquery-tablesort/jquery.tablesort.min.js',
            'jquery-form/jquery.form.js',
            'pace/pace.min.js',
            'toastr/toastr.min.js',
            'datetimepicker/build/jquery.datetimepicker.full.min.js',
            'gokyuzu/js/external/jquery-ui.min.js',
        ], config.jsPath+'admin.min.js', config.directory)
    ;

    mix
        .styles([
            'codemirror/lib/codemirror.css',
            'codemirror/theme/eclipse.css'
        ], config.cssPath+'editor.min.css', config.directory)
        .scripts([
            'codemirror/lib/codemirror.js',
            'codemirror/mode/htmlmixed/htmlmixed.js',
            'codemirror/mode/javascript/javascript.js',
            'codemirror/mode/css/css.js',
            'codemirror/mode/xml/xml.js',
            'codemirror/mode/clike/clike.js',
            'codemirror/mode/php/php.js',
            'codemirror/mode/yaml/yaml.js',
            'tinymce-dist/tinymce.jquery.min.js'
        ], config.jsPath+'editor.min.js', config.directory)
        .copy(config.directory+'tinymce-dist/themes', config.jsPath+'themes')
        .copy(config.directory+'tinymce-dist/skins', config.jsPath+'skins')
        .copy(config.directory+'tinymce-dist/plugins', config.jsPath+'plugins')
        .copy(config.directory+'gokyuzu/js/external/tinymce/langs', config.jsPath+'langs')
    ;

    mix
        .styles([
            'fullcalendar/dist/fullcalendar.min.css',
            'fullcalendar/dist/fullcalendar.print.css',
            'jquery-minicolors/jquery.minicolors.css',
            'flexslider/flexslider.css'
        ], config.cssPath+'plugin.min.css', config.directory)
        .copy(config.directory+'jquery-minicolors/jquery.minicolors.png', config.cssPath+'jquery.minicolors.png')
        .copy(config.directory+'flexslider/fonts', config.cssPath+'fonts')
        .copy(config.directory+'flexslider/images', config.cssPath+'images')
        .scripts([
            'jquery-backstretch/jquery.backstretch.min.js',
            'jquery-minicolors/jquery.minicolors.min.js',
            'nestable/jquery.nestable.js',
            'flexslider/jquery.flexslider-min.js',
            'fullcalendar/dist/fullcalendar.min.js',
            'fullcalendar/dist/locale/tr.js'
        ], config.jsPath+'plugin.min.js', config.directory)
    ;

    mix
        .styles([

        ], config.cssPath+'chart.min.css', config.directory)
        .scripts([
            'highcharts/highcharts.js',
            'highcharts/modules/exporting.js',
        ], config.jsPath+'chart.min.js', config.directory)
    ;

    mix
        .styles([
            'gokyuzu/css/app.css',
            'gokyuzu/css/skeleton.css',
            'gokyuzu/css/helper.css',
            'gokyuzu/css/page.css',
            'gokyuzu/css/bootstrap.css',
            'gokyuzu/css/responsive.css'
        ], config.cssPath+'app.min.css', config.directory)
        .scripts(['gokyuzu/js/app.js'], config.jsPath+'app.min.js', config.directory)
    ;

    mix.copy(config.directory+'gokyuzu/image', config.assetPath+'image');

    mix.version([
        'assets/css/admin.min.css', 'assets/js/admin.min.js',
        'assets/css/plugin.min.css', 'assets/js/plugin.min.js',
        'assets/css/editor.min.css', 'assets/js/editor.min.js',
        'assets/css/chart.min.css', 'assets/js/chart.min.js',
        'assets/css/app.min.css', 'assets/js/app.min.js',
    ]);
});