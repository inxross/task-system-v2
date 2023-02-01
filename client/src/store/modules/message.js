import axios from 'axios';

const state = {
    messageList: [],
};

const getters = {
    messageList: state => state.messageList,
};

const mutations = {
    updateMessageList(state, newMessageList) {
        state.messageList = newMessageList;
    },
};

const actions = {
    updateMessageList({ commit }) {
        axios.get(
            '/api/message/index'
        )
        .then(response => {
            console.log(response);
            const newMessageList = response.data.messages;
            commit('updateMessageList', newMessageList);
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions
}
