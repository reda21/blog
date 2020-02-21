export const doneTodos =  state => {
    return state.todos.filter(todo => todo.done)
}

export const count = state => state.count
