import axios from 'axios';

const state = {
    fileList: [],
};

const getters = {
    fileList: state => state.fileList,
};

const mutations = {
    updateFileList(state, newFileList) {
        state.fileList = newFileList;
    },
};

const actions = {
    updateFileList({ commit }, taskId) {
        axios.post(
            '/api/file/index',
            {
                taskId: taskId
            }
        )
        .then(response => {
            console.log(response);
            const newFileList = response.data.files;
            commit('updateFileList', newFileList);
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions
}
