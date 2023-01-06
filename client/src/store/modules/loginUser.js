import axios from 'axios';
import router from '../../router.js';

const state = {
    loginUser: null,
};

const getters = {
    loginUser: state => state.loginUser,
};

const mutations = {
    updateLoginUser(state, newLoginUser) {
        state.loginUser = newLoginUser;
    },
};

const actions = {
    login({ commit }, loginData) {
        axios.post(
            '/api/auth/login',
            {
                loginData: loginData
            }
        )
        .then(response => {
            console.log(response);
            const newLoginUser = response.data.user;
            commit('updateLoginUser', newLoginUser);
            router.push({
                name: "TaskIndex"
            });
        });
    },
};

export default {
    state,
    getters,
    mutations,
    actions
}
