const path = require('path')
const mix = require('laravel-mix')
// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

mix
  .js('resources/assets/js/app.js', 'public/js')
  .stylus('resources/assets/stylus/app.styl', 'public/css')
  .disableNotifications()
  .copyDirectory('resources/assets/img', 'public/img')
  .sourceMaps()

if (mix.inProduction()) {
  mix.version()

  mix.extract([
    'vue',
    'vform',
    'axios',
    'vuex',
    'vue-i18n',
    'vue-meta',
    'js-cookie',
    'vue-router',
    'vuetify',
    'vee-validate',
    'vuex-router-sync'
  ])
} else {
  mix.webpackConfig({
    devtool: 'inline-source-map'
  })
}

mix.webpackConfig({
  plugins: [
  ],
  resolve: {
    alias: {
      '~': path.join(__dirname, './resources/assets/js')
    }
  }
})
