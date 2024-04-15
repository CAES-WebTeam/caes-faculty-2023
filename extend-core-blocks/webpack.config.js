const fs = require('fs');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,

    entry: generateEntryPoints(),

    output: {
        path: path.resolve(__dirname, 'build'),
        filename: '[name].js'
    },

    plugins: [
        ...defaultConfig.plugins,
        new RemoveEmptyScriptsPlugin(),
    ],
};

function generateEntryPoints() {
    const srcPath = path.resolve(process.cwd(), 'src');
    const pluginFolders = fs.readdirSync(srcPath, { withFileTypes: true })
        .filter(dirent => dirent.isDirectory())
        .map(dirent => dirent.name);

    const entryPoints = {};
    pluginFolders.forEach(pluginName => {
        const pluginPath = path.join(srcPath, pluginName);
        const pluginFiles = fs.readdirSync(pluginPath);
        console.log('PluginFiles', pluginFiles);
        pluginFiles.forEach(file => {
            const extension = path.extname(file);
            const basename = path.basename(file, extension);
            const entryName = `${pluginName}/${basename}`;
            entryPoints[entryName] = path.resolve(pluginPath, file);
        });
    });

    return entryPoints;
}