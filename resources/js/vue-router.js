import Vue from "vue";
import VueRouter from "vue-router"
//conponent
import chatPage from "./components/chat/chatPage.vue"
import chatPageEmpty from "./components/chat/chatPageEmpty";

let myMixin;
if (typeof(isRouter) != "undefined" && isRouter) {
    Vue.use(VueRouter);

    let routes;
// 2. Define route components
    switch (isRouter) {
        case "chat":
            routes = [
                {
                    path: '/',
                    name: "chat",
                    component: chatPageEmpty
                },
                {
                    path: '/:slug',
                    name: "chat.show",
                    component: chatPage
                },
                {
                    path: '*',
                    redirect: '/'
                }

            ];
            break;
    }

    // 3. Create the router
    const router = new VueRouter({
        //     mode: 'hash',
        mode: 'history',
        base: BaseRouterUrl,
        routes
    });

    myMixin = {
        router
    };
} else {
    myMixin = {};
}

console.log({myMixin});

export default myMixin;
