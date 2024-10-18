const path = require("path");

module.exports = {
    entry: "./assets/main.js", // Fichier JavaScript principal
    output: {
        filename: "bundle.js", // Le fichier de sortie
        path: path.resolve(__dirname, "dist/js"), // Dossier de sortie
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ['@babel/preset-env'], // Utiliser le preset-env de Babel
                        plugins: ['@babel/plugin-transform-modules-commonjs'],
                    },
                },
            },
        ],
    },
};
