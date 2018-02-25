const path = require('path');

module.exports = {
    entry: './wp-content/themes/norwalk/js/norwalk.js',
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['babel-preset-env', {
                                targets: {
                                    browsers: ['last 2 versions'],
                                },
                            }],
                        ],
                    },
                },
            },
        ],
    },
    output: {
        filename: 'norwalk.min.js',
        path: path.resolve(__dirname, 'wp-content/themes/norwalk/js/min'),
    },
};
