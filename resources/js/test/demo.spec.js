import { shallowMount, createLocalVue } from "@vue/test-utils"
import store from "../store"

console.log(store.state.todos.length);
test('it works', () => {
    store.commit("addTodo", {name: "reda"});
  //  console.log(store.state.todos.length);
    expect(store.state.todos.length).toBe(1);
})

