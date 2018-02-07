const webpack = require('webpack');
const path = require('path');
const ENVIRONMENT = process.env.NODE_ENV || 'development';
const ExtractTextPlugin = require('extract-text-webpack-plugin');

const PATHS = {
	src: path.resolve(__dirname, 'source'),
	public: path.resolve(__dirname, 'public/js'),
};

let config = {
	context: PATHS.src,
	entry: {
		bundle: './index.js',
		admin: './admin.js'
	},
	output: {
		filename: '[name].js',
		path: PATHS.public
	},
	resolve: {
		extensions: ['.js', '.jsx', '.css']
	},
	module: {
		rules: [
			{
				test: /\.jsx?$/,
				loader: 'babel-loader',
			},

			{
				test: /\.woff($|\?)|\.woff2($|\?)|\.ttf($|\?)|\.eot($|\?)|\.svg($|\?)/,
				loader: 'url-loader'
			},

			{
				test: /\.scss$/,
				use: ExtractTextPlugin.extract({
					fallback: 'style-loader',
					//resolve-url-loader may be chained before sass-loader if necessary
					use: ['css-loader', 'resolve-url-loader', 'sass-loader']
				})
			}
		]
	},
	plugins: [
		new webpack.DefinePlugin({
			'process.env.NODE_ENV': JSON.stringify(ENVIRONMENT)
		}),
		new ExtractTextPlugin("css/[name].css")
	],
	node: {
		process: false
	}
};

if (ENVIRONMENT === 'production') {
	config.plugins.push(
		new webpack.optimize.UglifyJsPlugin({
			compress: {
				drop_console: false,
				warnings: false
			}
		})
	);
}

module.exports = config;