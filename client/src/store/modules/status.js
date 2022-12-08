import axios from 'axios';

const state = {
    statusList: [],
};

const getters = {
    statusList: state => state.statusList,
};

const mutations = {
    updateStatusList(state, newStatusList) {
        state.statusList = newStatusList;
    },
};

const actions = {
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
};

export default {
    state,
    getters,
    mutations,
    actions
}
