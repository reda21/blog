import axios from "axios";
import StoreData from './../StoreData'
import {orderBy, slice} from "lodash"

export default {
    state: {
        followings: new StoreData(),
        pagination: {
            per_page: 5,    // required
            current_page: 1, // required
            last_page: 1    // required
        },
    },
    mutations: {
        getFollowings(state, data) {
            console.warn({followings: data});
            state.followings.syncro(data);
        },
    },
    actions: {
        async getFollowings({commit}, {user, callback}) {
            let {data} = await axios.get("/api/user/" + user + "/following").catch(function (error) {
                // handle error
                console.log({tics: error});
                callback();
            });
            commit("getFollowings", data.data);
            callback();
        },
    },
    getters: {
        followings: (state, getters, rootState) => state.followings.all(),
        followingsPagination: (state, getters, rootState) => state.pagination,
        followingsOrdre: (state, getters, rootState) => orderBy(getters.followings, ['username'], ['asc']),
        followingsPaginated: (state, getters, rootState) => {
            let data = getters.followingsOrdre;
            let start = (state.pagination.per_page * (state.pagination.current_page - 1));
            let end = ((state.pagination.per_page * state.pagination.current_page) > data.lenght) ? data.lenght : (state.pagination.per_page * state.pagination.current_page);

            console.log({start, end});
            return slice(data, start, end);
        },
    }
};
