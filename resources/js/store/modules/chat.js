import StoreData from './../StoreData'
import axios from "axios";

export default {
    state: {
        math: 0,
        conversations: new StoreData(),
        messages: new  StoreData(),
        contact: new StoreData(),
        loading: true
    },
    mutations: {
        test(state, todo) {
            state.math = 5;
        },

        synchoConversations(state, {data}) {
            state.conversations.syncro(data);
        },

        addConversation(state, data) {
            state.conversations.set(data);
        },

        deletConversation(state, id) {
            state.conversations.delete(id);
        },

        clearConversation(state) {
            state.conversations.deleteAll();
        },
        changeConversationLoading(state, bool) {
            state.loading = bool
        },
        synchMessages(state, {data}) {
            state.messages.syncro(data);
        },
    },
    actions: {
        addConversations({commit}) {
            axios.get('/api/chat').then(({data}) => {
                console.log({response: data})
                commit("synchoConversations", data);
                commit("changeConversationLoading", false);

            }).catch(error => {
                // handle error
                console.log({tics: error});
            });

        },
        async loadConversation({commit}, {slug, callback}) {
            let url = '/api/chat/' + slug;

            let {data} = await axios.get(url).catch(function (error) {
                // handle error
                console.error({error: error});
                callback();
            });
            commit("synchMessages", data);
            callback();
        }


    },
    getters: {
        conversations: (state, getters, rootState) => {
            return state.conversations.all();
        },
        lastConversation: (state, getters, rootState) => {
            return state.conversations.last();
        },
        loadingConversations: (state, getters, rootState) => {
            return state.loading;
        },
        messages: (state, getters, rootState) => {
            return state.messages.all();
        },
    }
};
