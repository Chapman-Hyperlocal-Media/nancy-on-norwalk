const path = require('path');
const webpack = require('webpack');

module.exports = {
    entry: './wp-content/themes/norwalk/js/norwalk.js',
    output: {
        filename: 'norwalk.min.js',
        path: path.resolve(__dirname, 'wp-content/themes/norwalk/js/min'),
    },
};
