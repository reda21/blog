import Vue from 'vue'
import Vuex from 'vuex'
import { mutations, STORAGE_KEY } from './mutations'
import actions from './actions'
import plugins from './plugins'

Vue.use(Vuex)

import socket from "vue-socket.io"

export default new Vuex.Store({
    state: {
        todos:  []
    },
    actions,
    mutations,
 //   plugins
})
