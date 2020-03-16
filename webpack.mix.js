const mix = require('laravel-mix');

const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const env = process.env.NODE_ENV ? process.env.NODE_ENV : "dev";

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
mix.browserSync('blog.me');


//**************** font ********************
//conposent
mix.copy("node_modules/moment/min/moment.min.js", "public/js");
mix.copy("node_modules/moment/locale/fr.js", "public/js");

//base
mix.js('resources/js/app.js', 'public/js').version();
mix.sass('resources/sass/app.scss', 'public/css').version();

if(env == "production"){
    mix.webpackConfig({
        plugins: [
            new BundleAnalyzerPlugin({
                openAnalyzer: false,
                defaultSizes: 'gzip',
                analyzerMode: 'static'
            })
        ]
    })
}else if(env == "dev"){
    mix.webpackConfig({
        plugins: [
            new BundleAnalyzerPlugin()
        ]
    })
}




