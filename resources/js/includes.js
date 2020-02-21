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
import VueRessource from 'vue-resource';

Vue.use(VueRessource);
Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
Vue.http.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//axios
window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'tok': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};





