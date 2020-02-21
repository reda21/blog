/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vue.config.debug = true;
window.Vue.config.devtools = true;
window.Vue.config.performance = true;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
require("./includes")
import store from "./store"
import components from "./components";

global.store = store;
const app = new Vue({
    el: '#app',
    data() {
        return {
            Switch: false
        }
    },
    store,
    computed: {
        darkSwitch: {
            // getter
            get: function () {
                let value = false;
                if (localStorage.getItem("darkSwitch") == "true" ) {
                    value = true
                }

                if (value) {
                    this.changeAttribute(true);
                }
                return value;
            },
            // setter
            set: function (nVar, oVar) {
                console.log({nVar, oVar, dif: nVar != oVar});
                if (nVar != oVar) {
                    localStorage.setItem("darkSwitch", nVar)
                    this.changeAttribute(nVar);
                }
            }
        }
    },
    components,
    methods: {
        changeAttribute(val) {
            if (val) {
                document.body.setAttribute("data-theme", "dark");
            } else {
                document.body.removeAttribute("data-theme");
            }
        },
        changeSwitch(){
            if(this.Switch){
                this.Switch = false;
                this.darkSwitch = false;
            }else {
                this.Switch = true;
                this.darkSwitch = true;
            }
        }
    },

});


