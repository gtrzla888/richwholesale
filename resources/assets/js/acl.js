import Vue from 'vue'
import { AclInstaller, AclCreate, AclRule } from 'vue-acl'
import router from '~/router'
import { mapGetters } from 'vuex'

Vue.use(AclInstaller)


export default new AclCreate({
  initial: 'public',
  notfound: '404',
  router,
  acceptLocalRules: true,
  globalRules: {
    isAdmin: new AclRule('admin').generate(),
    isPublic: new AclRule('public').or('admin').generate(),
    isLogged: new AclRule('user').and('inside').generate()
  }
})
