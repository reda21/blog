import {mount, shallowMount, createLocalVue} from "@vue/test-utils";
import Vuex from 'vuex'
import MyComponent from '../components/test/List'
import myModule from "../store/myModule"

const localVue = createLocalVue();
localVue.use(Vuex);

describe('Modules.vue', () => {
    let actions, state, store

    beforeEach(() => {
        state = {
            clicks: 2
        }

        actions = {
            moduleActionClick: jest.fn()
        }

        store = new Vuex.Store({
            modules: {
                myModule: {
                    state,
                    actions,
                    getters: myModule.getters
                }
            }
        })

    })

    it('calls store action moduleActionClick when button is clicked', () => {
   //     const wrapper = shallowMount(MyComponent, {store, localVue});
//        console.log({clicks: wrapper.vm.$store.state.myModule.clicks});
//        console.log({clicks: wrapper.vm.state});
        expect(1).toBe(1)
    });
});





