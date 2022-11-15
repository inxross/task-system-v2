import Vue from "vue";
import Router from "vue-router";
import Home from "./views/MyHome.vue";
import Users from "./views/MyUsers.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {path: '/', component: Home},
        {path: '/users', component: Users}
    ]
});
