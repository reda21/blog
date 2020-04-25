import Vue from 'vue'
import Vuex from 'vuex'
import getters from "./getters"
import actions from './actions'
import plugins from './plugins'

//modules
import notifications from "./modules/notifications"
import users from "./modules/users"

Vue.use(Vuex)

import socket from "vue-socket.io"

export default new Vuex.Store({
    modules:{
        notifications, users
    },
    actions,
    getters,
 //   plugins
})
