const mix = require('laravel-mix');
const webpack = require('webpack');

mix.webpackConfig({
    plugins: [
        new webpack.DefinePlugin({
            env: {
                BASE_URL: JSON.stringify(process.env.APP_URL)
            }
        })
    ]
});


mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
