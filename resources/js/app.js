/**
 * import Vue framwork
 */
import Vue from "vue"

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
                if (localStorage.getItem("darkSwitch") == "true") {
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
        changeSwitch() {
            if (this.Switch) {
                this.Switch = false;
                this.darkSwitch = false;
            } else {
                this.Switch = true;
                this.darkSwitch = true;
            }
        }
    },
    mounted() {
        if (window.messageSuccess) window.alertSuccess(window.messageSuccess);
        if (window.messageErrors) window.alertError(window.messageErrors);
    }

});



