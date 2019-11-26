'use strict';

const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

let config = {
    entry: {
        'bundle.css': [
            path.resolve(__dirname, 'src/Front/css/app.css')
        ],
        'bundle.js': [
            path.resolve(__dirname, 'src/Front/app.js')
        ]
    },
    output: {
        path: path.resolve(__dirname, 'public', 'assets', 'bundle'),
        filename: '[name]'
    },
    resolve: {
        extensions: ['.js', '.jsx', '.json', '.ts', '.tsx']
    },
    watchOptions: {
        aggregateTimeout: 250,
        poll: 500,
        ignored: /node_modules/
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx|tsx|ts)$/,
                exclude:path.resolve(__dirname, 'node_modules'),
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            '@babel/preset-env',
                            '@babel/preset-react',
                            '@babel/preset-typescript'
                        ],
                        plugins : [
                            ["@babel/plugin-proposal-decorators", { "legacy": true }],
                            '@babel/plugin-syntax-dynamic-import',
                            ['@babel/plugin-proposal-class-properties', { "loose": true }]
                        ]
                    }
                },
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [
                        {
                            loader: 'css-loader',
                        },
                        // 'postcss-loader',
                        'sass-loader'
                    ]
                })
            },
            {
                test: /.(png|woff(2)?|eot|ttf|svg|gif)(\?[a-z0-9=\.]+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '../css/[hash].[ext]'
                        }
                    }
                ]
            },
            {
                test : /\.css$/,
                use: ['style-loader', 'css-loader'] //, 'postcss-loader']
            }
        ]
    },
    externals: {
        ibexApp: 'ibexApp',
    },
    plugins: [
        new ExtractTextPlugin({
            filename: 'bundle.css',
            allChunks: true,
        }),
        new webpack.DefinePlugin({
            '__DEV__' : JSON.stringify(true),
            '__API_HOST__' : JSON.stringify('http://http://ibex.localhost:8080/'),
        }),
    ],

};

if (process.env.NODE_ENV === 'production') {
    config.plugins.push(
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: false,
            compress: {
                sequences: true,
                conditionals: true,
                booleans: true,
                if_return: true,
                join_vars: true,
                drop_console: true
            },
            output: {
                comments: false
            },
            minimize: true
        })
    );
}

module.exports = config;