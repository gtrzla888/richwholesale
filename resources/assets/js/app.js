import Vue from 'vue'
import Vuetify from 'vuetify'
import store from '~/store'
import router from '~/router'
import { i18n } from '~/plugins'
import App from '~/components/App'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@mdi/font/css/materialdesignicons.css'
import '@fortawesome/fontawesome-free/css/all.css'
import '~/components'
import acl from './acl'

Vue.use(Vuetify, {
  iconfont: 'md' || 'mdi' || 'fa' || 'fa4'
})

Vue.config.productionTip = false

new Vue({
  el: '#app',
  i18n,
  store,
  router,
  acl,
  ...App
})
