const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');
const glob = require('glob');

const entries = {};

glob.sync('./blocks/*/src/index.js').forEach((file) => {
    const blockName = file.match(/blocks\/(.*)\/src\/index.js/)[1];
    entries[blockName] = path.resolve(__dirname, file);
});

module.exports = {
    ...defaultConfig,
    entry: entries,
    output: {
        path: path.resolve(__dirname, 'blocks'),
        filename: '[name]/build/index.js',
    },
};