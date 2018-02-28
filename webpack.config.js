const webpack = require('webpack')
const path = require('path')

module.exports = {
    entry: path.resolve(__dirname, './src/public/js/main.js'),
    output: {
        path: path.resolve(__dirname, './src/public/min/'),
        filename: 'main.js'
    },
    mode: 'development',
    module: {
        rules: [{
            test: /\.scss$/,
            use: [{
                loader: "style-loader"
            }, {
                loader: "css-loader"
            }, {
                loader: "sass-loader",
                options: {
                    includePaths: [path.resolve(__dirname, './src/public/sass/**/')]
                }
            }]
        }]
    }
}
