import StoreData from './../StoreData'
import axios from "axios";

export default {
    state: {
        math: 0,
        list: new StoreData(),
        loading: true
    },
    mutations: {
        test(state, todo) {
            state.math = 5;
        },

        synchoNotif(state, {data}) {
            state.list.syncro(data);
        },

        addNotif(state, data) {
            state.list.set(data);
        },

        deletNotif(state, id) {
            state.list.delete(id);
        },

        clearNotif(state) {
            state.list.deleteAll();
        },
        changeNotifLoading(state, bool) {
            state.loading = bool
        }
    },
    actions: {
        async addNotifs({commit}) {
            let {data} = await axios.get('/api/notifications').catch(function (error) {
                // handle error
                console.log({tics:error});
            });
            data.date = Math.round(Date.now()/1000);
            console.log({response: data})
            commit("synchoNotif", data);
            commit("changeNotifLoading", false);

        },

        action_add_notification({commit}, data) {
            commit("addNotif", data);
        },

        action_delete_notification({commit}, id) {
            commit("deletNotif", id);
        },
    },
    getters: {
        notifications: (state, getters, rootState) => {
            return state.list.all();
        },
        notificationsCount: (state, getters, rootState) => {
            return getters.notifications.length;
        },
        loadingNotifications: (state, getters, rootState) => {
            return state.loading;
        },
    }
};
