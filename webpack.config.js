const path = require('path');

module.exports = {
  devtool: 'eval-source-map',
  context: path.resolve(__dirname, './resources/js/app.ts'),
  entry: path.resolve(__dirname, './resources/js/app.ts'),
  module: {
    rules: [
      {
        test: [/\.tsx?$/, /\.ts?$/],
        use: 'ts-loader',
        include: [path.resolve(__dirname, 'resources/js')]
      }
    ]
  },
  resolve: {
    extensions: ['.ts', '.js', '.tsx', '.sx', '.jsx']
  },
  output: {
    path: path.resolve(__dirname, 'public/js'),
    filename: 'app.js',
    publicPath: '/js/'
  },
  devServer: {
    host: "127.0.0.1",
    contentBase: path.resolve(__dirname, 'public'),
    port: 3000,
    proxy: {
      "*": "http://[::1]:80"
    }
  }
};
