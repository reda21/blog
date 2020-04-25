import axios from "axios";

let getUsers = async (url) => {
    let res = await axios.get(url);
    let {data} = res.data;
    return data;
};

const getData = async function (url) {
    await axios.get(url)
        .then(function (response) {
            console.log({response});
            return response;
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });


}
export default {


    /*
        removeTodo ({ commit }, todo) {
            commit('removeTodo', todo)
        },

        toggleTodo ({ commit }, todo) {
            commit('editTodo', { todo, done: !todo.done })
        },

        editTodo ({ commit }, { todo, value }) {
            commit('editTodo', { todo, text: value })
        },

        toggleAll ({ state, commit }, done) {
            state.todos.forEach((todo) => {
                commit('editTodo', { todo, done })
            })
        },

        clearCompleted ({ state, commit }) {
            state.todos.filter(todo => todo.done)
                .forEach(todo => {
                    commit('removeTodo', todo)
                })
        }
         */
}
