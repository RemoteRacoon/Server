const Encore = require('@symfony/webpack-encore');


Encore
  .enableSourceMaps(true)
  .setOutputPath('public/build')
  .setPublicPath('/build')
  .enableSassLoader()
  .addEntry('app', './assets/js/app.js')
  .cleanupOutputBeforeBuild();

module.exports = Encore.getWebpackConfig();