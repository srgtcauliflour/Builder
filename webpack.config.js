const webpack = require('webpack')
const path = require('path')
const ExtractTextPlugin = require("extract-text-webpack-plugin")
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')

/** 
 * Extract sass to .min.css file
 */
const extractSass = new ExtractTextPlugin({
    filename: "[name].css",
})

module.exports = {
    entry: path.resolve(__dirname, './src/public/js/main.js'),
    output: {
        path: path.resolve(__dirname, './src/public/min/'),
        filename: 'main.js'
    },
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: extractSass.extract({
                use: [
                        {
                            loader: "css-loader",
                            options: {
                                minimize: true
                            }
                        }, {
                            loader: "sass-loader"
                        }
                    ]
                })
            }
        ]
    },
    plugins: [
        extractSass,
        new UglifyJsPlugin({
            test: /\.js/
        })
    ]
}
