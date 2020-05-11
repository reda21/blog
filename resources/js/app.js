/**
 * import Vue framwork
 */
import Vue from "vue"

import VueSocketIO from "vue-socket.io"
import SocketIO from "socket.io-client"

Vue.config.debug = true;
Vue.config.devtools = true;
Vue.config.performance = true;


require("./bootstrap")
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
require("./directives")

require("./includes")

import store from "./store"

import components from "./components";

import './filter';

global.store = store;

Vue.use(new VueSocketIO({
//    debug: true,
    connection: 'http://localhost:1455',
    vuex: {
        store,
        actionPrefix: 'action_',
        mutationPrefix: 'mutation_',
        options: {
            useConnectionNamespace: true
        }
    },
    // options: { path: "/my-app/" } //Optional options
}));

import {useSwitch} from "./composition/useSwitch"
import {useProfile} from "./composition/useProfile"
import {mapActions, mapGetters} from "vuex"
import myMixin from "./vue-router";

console.log({useSwitch});

const app = new Vue({
    el: '#app',
    components,
    mixins: [myMixin],
    store,
    setup() {
        const [Switch] = useSwitch();

        const [profile] = useProfile();

        return {
            Switch, profile
        }
    },
    data() {
        return {
            alpha: 5
        }
    },
    computed: {
        listUserOnline() {
            return this.usersOnline.join(", ");
        },
        ...mapGetters(["usersOnline"])
    },
    methods: {
        ...mapActions(["AddUserOnline", "DeleteUserOnline", "SetUserProfile"])
    },
    sockets: {
        connect: function () {
            console.log('socket connected');
            this.SetUserProfile(this.profile);
            this.$socket.emit("identify", this.profile);
        },
        show_all_user_online(data) {
            console.log({show_all_user_online: data});
            this.AddUserOnline(data);
        },
        add_user_online(data) {
            console.log({add_user_online: data});
            this.AddUserOnline(data);
        },
        delete_user_online(data) {
            console.log({delete_user_online: data});
            this.DeleteUserOnline(data);
        },
        result(data) {
            console.log({result: data});
        },
        customEmit: function (data) {
            console.log('this method was fired by the socket server. eg: io.emit("customEmit", data)')
        }
    },
    mounted() {
        if (window.messageSuccess) window.alertSuccess(window.messageSuccess);
        if (window.messageErrors) window.alertError(window.messageErrors);
    }
});



