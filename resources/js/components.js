import friend from "./components/friends";
import Vue from "vue"
//layout
import bButton from "./components/layouts/button"

Vue.component("bButton", bButton);

//passport
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

//conponent
export default {
    friends: friend,
}
