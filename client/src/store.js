import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        categoryList: []
    },
    getters: {
        categoryList: state => state.categoryList,
    },
    mutations: {
        updateCategoryList(state, newCategoryList) {
            state.categoryList = newCategoryList;
        }
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
        }
    }
});
