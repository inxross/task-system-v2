import axios from 'axios';

const state = {
    categoryList: [],
};

const getters = {
    categoryList: state => state.categoryList,
};

const mutations = {
    updateCategoryList(state, newCategoryList) {
        state.categoryList = newCategoryList;
    },
};

const actions = {
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
};

export default {
    state,
    getters,
    mutations,
    actions
}
