import StoreData from './../StoreData'
import axios from "axios";
import {orderBy, slice} from "lodash";

export default {
    state: {
        followers: new StoreData(),
        requests: new StoreData(),
        paginationFollowers: {
            per_page: 5,    // required
            current_page: 1, // required
            last_page: 1    // required
        },
        paginationRequests: {
            per_page: 5,    // required
            current_page: 1, // required
            last_page: 1    // required
        },
    },
    mutations: {
        getFollowers(state, data) {
            console.warn({getFollowers: data});
            state.followers.syncro(data);
        },
        getRequests(state, data) {
            console.warn({getRequests: data});
            state.requests.syncro(data);
        },
        tranfertRequest(state, username) {
            let data = state.requests.get(username, 'username');
            data.date = Math.round(Date.now() / 1000);
            console.info({date: Math.round(Date.now()/1000)})
            state.followers.set(data);
            state.requests.delete(data.id);
        },
        ressetRequest(state, username) {
            let data = state.requests.get(username, 'username');
            state.requests.delete(data.id);
        },
    },
    actions: {
        async getFollowers({commit}, {user, callback}) {
            let {data} = await axios.get("/api/user/" + user + "/followers").catch(function (error) {
                // handle error
                console.log({tics: error});
                callback();
            });
            commit("getFollowers", data.data);
            if (data.request)
                commit("getRequests", data.request);
            callback();
        },
        async confirmedRequest({commit}, {username, callback}) {
            await axios.post("/api/user/" + username + "/request", {response: 'confirme'}).catch(function (error) {
                // handle error
                console.log({tics: error});
                callback();
            });
            commit("tranfertRequest", username);
            callback();
        },
        async ressetRequest({commit}, {username, callback}) {
            await axios.post("/api/user/" + username + "/request", {response: 'reset'}).catch(function (error) {
                // handle error
                console.log({tics: error});
                callback();
            });
            commit("ressetRequest", username);
            callback();
        }
    },
    getters: {
        followers: (state, getters, rootState) => {
            return state.followers.all();
        },
        requests: (state, getters, rootState) => {
            return state.requests.all();
        },
        followersPagination: (state, getters, rootState) => state.paginationFollowers,
        followersOrdre: (state, getters, rootState) => orderBy(getters.followers, ['username'], ['asc']),
        followersPaginated: (state, getters, rootState) => {
            let data = getters.followersOrdre;
            let start = (state.paginationFollowers.per_page * (state.paginationFollowers.current_page - 1));
                        let end = ((state.paginationFollowers.per_page * state.paginationFollowers.current_page) > data.lenght) ? data.lenght : (state.paginationFollowers.per_page * state.paginationFollowers.current_page);

            console.log({start, end});
            return slice(data, start, end);
        },
        requestsPagination: (state, getters, rootState) => state.paginationRequests,
        requestsOrdre: (state, getters, rootState) => orderBy(getters.requests, ['date'], ['desc']),
        requestsPaginated: (state, getters, rootState) => {
            let data = getters.requestsOrdre;
            let start = (state.paginationRequests.per_page * (state.paginationRequests.current_page - 1));
            let end = ((state.paginationRequests.per_page * state.paginationRequests.current_page) > data.lenght) ? data.lenght : (state.paginationRequests.per_page * state.paginationRequests.current_page);

            console.log({start, end});
            return slice(data, start, end);
        },
    }
};
