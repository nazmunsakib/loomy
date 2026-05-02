const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const glob = require('glob');

const entries = {};

glob.sync('./blocks/*/src/{index,view}.js').forEach((file) => {
    const match = file.match(/blocks\/(.*)\/src\/(index|view)\.js/);
    const blockName = match[1];
    const type = match[2];
    entries[`${blockName}/build/${type}`] = path.resolve(__dirname, file);
});

module.exports = {
    ...defaultConfig,
    entry: entries,
    output: {
        path: path.resolve(__dirname, 'blocks'),
        filename: '[name].js',
    },
};