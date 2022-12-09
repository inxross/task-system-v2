import Vue from 'vue';
import Vuex from 'vuex';
//import axios from 'axios';
import category from "./modules/category.js";
import task from "./modules/task.js";
import user from "./modules/user.js";
import status from "./modules/status.js";
import comment from "./modules/comment.js";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {

    },
    getters: {

    },
    mutations: {

    },
    actions: {

    },
    modules: {
        category,
        task,
        user,
        status,
        comment
    }
});
