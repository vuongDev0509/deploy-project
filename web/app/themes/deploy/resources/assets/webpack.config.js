const TerserJSPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const path = require('path');

module.exports = {
    devtool: 'source-map',
    optimization: {
        minimizer: [new TerserJSPlugin({}), new OptimizeCSSAssetsPlugin({})],
    },
    resolve: {
        modules: ['node_modules', path.resolve(__dirname, './fonts')]
    },
    entry: {
        app: ['./resources/assets/scss/main.scss'],
        functions: ['./resources/assets/js/functions.js'],
        'formdata-polyfill': [/*'core-js/stable',*/ './resources/assets/js/FormData-polyfill.js'],
        blocks: ['./resources/assets/blocks/block-styles.js'],
        editor: ['./resources/assets/scss/editor.scss'],
    },
    output: {
        path: path.resolve('./', 'dist'),
        filename: '[name].js',
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env',
                                {
                                    "corejs": {"version": 3},
                                    "useBuiltIns": "usage",
                                    "targets": {
                                        "browsers": [
                                            "edge >= 16",
                                            "safari >= 9",
                                            "firefox >= 57",
                                            "ie >= 10",
                                            "ios >= 9",
                                            "chrome >= 49"
                                        ]
                                    }
                                }
                            ]
                        ],
                        "plugins": [
                            ["@babel/plugin-transform-arrow-functions", {"spec": true}],
                            ["@babel/plugin-proposal-decorators", {"decoratorsBeforeExport": true}],
                            ["@babel/plugin-proposal-class-properties"],
                            ["@babel/transform-runtime"]
                        ]
                    }
                }
            },
            {
                test: /\.(svg|png|jpg|webp)(\?v=\d+\.\d+\.\d+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: 'assets/'
                        }
                    }
                ]
            },
            {
                test: /\.(woff(2)?|ttf|eot)(\?v=\d+\.\d+\.\d+)?$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: '[name].[ext]',
                            outputPath: 'assets/fonts'
                        }
                    }
                ]
            },
            {
                test: /\.(sa|sc|c)ss$/s,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: '',
                        },
                    },
                    'css-loader',
                    'resolve-url-loader',
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true,
                            sassOptions: {
                                outputStyle: 'compressed',
                            },
                        },
                    },
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
            chunkFilename: '[id].css',
        }),
    ],
    devServer: {
        contentBase: path.join(__dirname, 'dist'),
        compress: true,
        port: 9000,
        hot: true,
        index: '',
        proxy: {
            context: () => true,
            target: 'http://ausdeck.test'
        },
        liveReload: true,
        host: 'localhost',
        port: 8080,
        http2: true,
    }
};
