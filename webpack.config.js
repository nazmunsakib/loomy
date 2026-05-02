import defaultConfig from '@wordpress/scripts/config/webpack.config.js';
import path from 'path';
import glob from 'glob';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const entries = {};

// In glob v7 CJS interop, 'glob' is the default export
const sync = glob.sync || glob;

sync('./blocks/*/src/{index,view}.js').forEach((file) => {
    const match = file.match(/blocks\/(.*)\/src\/(index|view)\.js/);
    const blockName = match[1];
    const type = match[2];
    entries[`${blockName}/build/${type}`] = path.resolve(__dirname, file);
});

export default {
    ...defaultConfig,
    entry: entries,
    output: {
        path: path.resolve(__dirname, 'blocks'),
        filename: '[name].js',
    },
};