import Vue from "vue"
//layout

const layout = require.context('./components/layouts', true, /\.vue$/i)

layout.keys().map(key => {
    console.log(key);
})

layout.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], layout(key).default))

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
import friend from "./components/user/friends";
import EditProfile from "./components/user/editProfile"
import editAccount from "./components/user/editAccount"
import editAvatar from "./components/user/editAvatar"
import editCover from "./components/user/editCover"

export default {
    friends: friend,
    EditProfile,
    editAccount,
    editAvatar,
    editCover,
}

