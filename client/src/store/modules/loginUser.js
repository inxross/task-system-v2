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
        const loginUserInLocalStorage = JSON.parse(localStorage.getItem('loginUserInLocalStorage'));
        if (!loginUserInLocalStorage) return;
        commit('updateLoginUser', loginUserInLocalStorage);
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
            commit('updateLoginUser', newLoginUser);

            const jsonNewLoginUser = JSON.stringify(response.data.user);
            localStorage.setItem('loginUserInLocalStorage', jsonNewLoginUser);

            router.push({
                name: "TaskIndex"
            });
        });
    },
    logout({ commit }) {
        commit('updateLoginUser', null);
        localStorage.removeItem('loginUserInLocalStorage');
        router.replace('/login');
    }
};

export default {
    state,
    getters,
    mutations,
    actions
}
