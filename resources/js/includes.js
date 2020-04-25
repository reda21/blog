require("jquery-confirm")
//query-confirm
window.confirms = (message, Confirmer, Annuler) => {
    window.$.confirm({
        icon: 'glyphicon glyphicon-trash',
        title: 'Confirm!',
        content: message,
        buttons: {
            Confirmer: {
                keys: ['enter', 'shift'],
                text: 'Confirmer',
                btnClass: 'btn-red',
                action: Confirmer
            },
            Annuler: {
                //    keys: ['enter', 'shift'],
                text: 'Annuler',
                btnClass: 'btn-green',
                action: Annuler
            }
        }
    });
};

window.confirmWithResponse = (message, accepter, Refuser, Annuler) => {
    //  debugger;
    $.confirm({
        icon: 'glyphicon glyphicon-trash',
        title: 'Confirm!',
        content: message,
        buttons: {
            done: {
                text: 'Oui',
                btnClass: 'btn-green',
                action: accepter
            },
            doNotAskAgain: {
                text: 'Non',
                action: Refuser
            },
            donate: {
                text: 'Annuler',
                btnClass: 'btn-default',
                action: Annuler
            }

        }
    });
};
//VueRessource
import Vue from "vue"
import VueRessource from 'vue-resource';

require("bootstrap-datepicker")
require("bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min")
/**
 import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'

 // Install BootstrapVue
 Vue.use(BootstrapVue)
 // Optionally install the BootstrapVue icon components plugin
 Vue.use(IconsPlugin)
 */
import VueCompositionApi from '@vue/composition-api';
Vue.use(VueCompositionApi);

Vue.use(VueRessource);
Vue.http.options.root = ApiUrl;
Vue.http.options.emulateJSON = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
Vue.http.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//axios
window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'tok': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

//vee-validate
import "./vee-validate"





