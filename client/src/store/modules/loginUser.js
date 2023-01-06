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
    autoLogin({commit}) {
        const loginUserInLocalStorage = localStorage.getItem('loginUserInLocalStorage');
        if (!loginUserInLocalStorage) return;
        commit('updateLoginUser')
    },
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

            const jsonNewLoginUser = JSON.stringify(response.data.user);
            localStorage.setItem('loginUserInLocalStorage', jsonNewLoginUser);

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
