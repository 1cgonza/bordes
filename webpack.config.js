const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const autoprefixer = require('autoprefixer');
const WriteFilePlugin = require('write-file-webpack-plugin');

module.exports = (env, options) => {
  return {
    devServer: {
      disableHostCheck: true
    },
    devtool: options.mode === 'development' ? 'eval-source-map' : false,
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader'
          }
        },
        {
          test: /\.(ico|gif|png|jpe?g|svg)&/,
          use: {
            loader: 'url-loader'
          }
        },
        {
          test: /\.(scss|css)$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader'
            },
            {
              loader: 'postcss-loader',
              options: {
                autoprefixer: {
                  browsers: ['last 2 versions']
                },
                plugins: () => [autoprefixer]
              }
            },
            {
              loader: 'sass-loader',
              options: {}
            }
          ]
        }
      ]
    },
    plugins: [new MiniCssExtractPlugin(), new WriteFilePlugin()],
    watchOptions: {
      ignored: ['/node_modules/']
    }
  };
};
