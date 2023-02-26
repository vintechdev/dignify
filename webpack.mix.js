const mix = require('laravel-mix');
// var LiveReloadPlugin = require('webpack-livereload-plugin');

/**
 * Compile CSS
 */
mix.sass('resources/scss/admin.scss', 'public/css', { implementation: require('node-sass') });
// mix.sass('resources/scss/public.scss', 'public/css', { implementation: require('node-sass') });


/**
 * Compile JS
 */
mix.js('resources/js/admin.js', 'public/js');
//mix.js('resources/js/public.js', 'public/js');

mix.js([
    'resources/js/public/smoothscroll.js',
    'resources/js/public/jquery.validate.min.js',
    'resources/js/public/jquery.stellar.min.js',
    'resources/js/public/jquery.magnific-popup.js',
    'resources/js/public/owl.carousel.min.js'
], 'public/js/front-common-vendor.js');


mix.js([
    'resources/js/public/rev-slider/revolution.extension.actions.min.js',
    'resources/js/public/rev-slider/revolution.extension.carousel.min.js',
    'resources/js/public/rev-slider/revolution.extension.kenburn.min.js',
    'resources/js/public/rev-slider/revolution.extension.layeranimation.min.js',
    'resources/js/public/rev-slider/revolution.extension.migration.min.js',
    'resources/js/public/rev-slider/revolution.extension.navigation.min.js',
    'resources/js/public/rev-slider/revolution.extension.parallax.min.js',
    'resources/js/public/rev-slider/revolution.extension.slideanims.min.js',
    'resources/js/public/rev-slider/revolution.extension.video.min.js',
], 'public/js/rev-vendor.js');

mix.js('resources/js/public/interface.js', 'public/js/interface.js');

/**
 * Copy font-awesome files
 */
mix.copy('node_modules/font-awesome/fonts', 'public/fonts');

/**
 * Copy CKEditor main files
 */
mix.copy('node_modules/ckeditor4/ckeditor.js', 'public/components/ckeditor4/ckeditor.js');
mix.copy('node_modules/ckeditor4/contents.css', 'public/components/ckeditor4/contents.css');

/**
 * Copy CKEditor lang files
 */
mix.copy('node_modules/ckeditor4/lang/fr.js', 'public/components/ckeditor4/lang/fr.js');
mix.copy('node_modules/ckeditor4/lang/es.js', 'public/components/ckeditor4/lang/es.js');
mix.copy('node_modules/ckeditor4/lang/nl.js', 'public/components/ckeditor4/lang/nl.js');
mix.copy('node_modules/ckeditor4/lang/en.js', 'public/components/ckeditor4/lang/en.js');

/**
 * Copy CKEditor plugins files
 */
var plugins = [
    'dialog',
    'dialogadvtab',
    'div',
    'image',
    'image2',
    'justify',
    'link',
    'magicline',
    'panelbutton',
    'pastefromgdocs',
    'pastefromword',
    'pastetools',
    'scayt',
    'showblocks',
    'specialchar',
    'table',
    'tableselection',
    'tabletools',
    'widget',
    'wsc',
];
plugins.forEach(function (plugin) {
    mix.copy('node_modules/ckeditor4/plugins/' + plugin, 'public/components/ckeditor4/plugins/' + plugin);
});

/**
 * Copy CKEditor skins files
 */
mix.copy('node_modules/ckeditor4/skins', 'public/components/ckeditor4/skins');

/**
 * Versioning process
 */
mix.version();

/**
 * BrowserSync
 */
mix.browserSync('typicms.test');

/**
 * Options
 */
mix.options({
    processCssUrls: false,
});

/**
 * Livereload
 */
// mix.webpackConfig({
//     plugins: [new LiveReloadPlugin()],
// });

/**
 * Source maps
 */
// if (!mix.inProduction()) {
//     mix.webpackConfig({
//         devtool: 'source-map',
//     }).sourceMaps();
// }
