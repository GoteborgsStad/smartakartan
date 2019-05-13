const path = require('path');
//const ExtractTextPlugin = require("extract-text-webpack-plugin");
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const WebpackNotifierPlugin = require('webpack-notifier');

module.exports = {
	mode: 'development',
	devtool: 'eval',
	entry: './assets/index.js',
	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: 'bundle.js'
	},
	module: {
		rules: [
/* 		{
			test: require.resolve('jquery'),
			use: [
				{
					loader: 'expose-loader',
					options: '$'
				},
				{
					loader: 'expose-loader',
					options: 'jQuery'
				}
			]
		}, */
		{
			test: /\.js$/,
			exclude: /(node_modules)/,
			use: {
				loader: 'babel-loader',
				options: {
					presets: ['env']
				}
			}
		},
		{
			test: /\.css$/,
			use: [
				MiniCssExtractPlugin.loader,
				{
					loader: 'css-loader',
					options: {
						sourceMap: true
					},
				},
			]
		},
		{
			test: /\.scss$/,
			use: [
				MiniCssExtractPlugin.loader,
				{
					loader: 'css-loader',
					options: {
						sourceMap: true
					},
				},
				{
					loader: 'sass-loader',

					options: {
						sourceMap: true
					},
				},
			]
		},
		{
			test: /\.(png|svg|jpg|gif)$/,
			use: [
				'file-loader?name=images/[name].[ext]'
			]
		}
		],
	},
	watch: true,
	devtool: 'source-map',
	plugins: [
        new WebpackNotifierPlugin({
            alwaysNotify: true
        }),
		new MiniCssExtractPlugin({
			filename: 'style.css'
		})
	]
}
