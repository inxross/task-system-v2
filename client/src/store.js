import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        categoryList: [],
        statusList: [],
    },
    getters: {
        categoryList: state => state.categoryList,
        statusList: state => state.statusList,
    },
    mutations: {
        updateCategoryList(state, newCategoryList) {
            state.categoryList = newCategoryList;
        },
        updateStatusList(state, newStatusList) {
            state.statusList = newStatusList;
        },
    },
    actions: {
        updateCategoryList({ commit }) {
            axios.get(
                '/api/category/index'
            )
            .then(response => {
                console.log(response);
                const newCategoryList = response.data.categories;
                commit('updateCategoryList', newCategoryList);
            });
        },
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
    }
});
