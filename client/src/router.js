import Vue from "vue";
import Router from "vue-router";
import Test from "./views/MyTest.vue";
import TaskIndex from "@/pages/task/TaskIndex.vue";
import TaskCreate from "@/pages/task/TaskCreate.vue";
import UserIndex from "@/pages/user/UserIndex.vue";
import CategoryIndex from "@/pages/category/CategoryIndex.vue";
import CategoryCreate from "@/pages/category/CategoryCreate.vue";


Vue.use(Router);

export default new Router({
    mode: "history",
    routes: [
        {path: '/', component: TaskIndex},
        {path: '/task/create', component: TaskCreate},

        {path: '/user/index', component: UserIndex},

        {path: '/category/index', component: CategoryIndex},
        {path: '/category/create', component: CategoryCreate, name: 'CategoryCreate'},

        {path: '/mytest', component: Test},
        {path: '*', redirect: '/'},
    ]
});
