import StoreData from './../StoreData'
import axios from "axios";

export default {
    state: {
        myProfile: {},
        user: {},
        usersOnline: []
    },
    mutations: {
        SetUserProfile(state, data) {
            console.log({SetUserProfile: data});
            state.myProfile = data;
        },
        AddUserOnline: (state, data) => {
            if (typeof data == "object") {
                data.forEach(o => {
                    let findData = state.usersOnline.find(u => u == o);

                    if (!findData) {
                        state.usersOnline.push(o);
                        console.log("add");
                    }
                })
            } else {
                let find = state.usersOnline.find(u => u == data);

                if (!find) {
                    state.usersOnline.push(data);
                    console.log("add one");
                }
            }
        },
        DeleteUserOnline: (state, data) => {
            let index = state.usersOnline.findIndex(u => u == data);
            console.log(index);

            if (index > -1) {
                state.usersOnline.splice(index, 1);
                console.log("delete");
            }
        }
    },
    actions: {
        AddUserOnline: ({commit}, data) => commit("AddUserOnline", data),
        DeleteUserOnline:({commit}, data) => commit("DeleteUserOnline", data),
        SetUserProfile: ({commit}, data) => commit("SetUserProfile", data)
    },
    getters: {
        myProfile: (state, getters, rootState) => state.myProfile,
        usersOnline: (state) => state.usersOnline,
    }
};
