import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import category from "./modules/category.js";
import task from "./modules/task.js";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {

        statusList: [],
    },
    getters: {

        statusList: state => state.statusList,
    },
    mutations: {

        updateStatusList(state, newStatusList) {
            state.statusList = newStatusList;
        },
    },
    actions: {

        updateStatusList({ commit }) {
            axios.get(
                '/api/status/index'
            )
            .then(response => {
                console.log(response);
                const newStatusList = response.data.statuses;
                commit('updateStatusList', newStatusList);
            });
        },
    },
    modules: {
        category,
        task
    }
});
