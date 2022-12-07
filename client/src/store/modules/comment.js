import axios from 'axios';
//import router from '../../router';

const state = {
    commentList: [],
};

const getters = {
    commentList: state => state.commentList,
};

const mutations = {
    updateCommentList(state, newCommentList) {
        state.commentList = newCommentList;
    },
};

const actions = {
    updateCommentList({ commit }, id) {
        console.log(id);
        axios.post(
            '/api/comment/index',
            {
                task_id: id
            }
        )
        .then(response => {
            console.log(response);
            const newCommentList = response.data.comments;
            commit('updateCommentList', newCommentList);
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions
}
