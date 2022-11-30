import axios from 'axios';

const state = {
    taskList: [],
};

const getters = {
    taskList: state => state.taskList,
};

const mutations = {
    updateTaskList(state, newTaskList) {
        state.taskList = newTaskList;
    },
};

const actions = {
    updateTaskList({ commit }) {
        axios.get(
            '/api/task/index'
        )
        .then(response => {
            console.log(response);
            const newTaskList = response.data.tasks;
            commit('updateTaskList', newTaskList);
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions
}
