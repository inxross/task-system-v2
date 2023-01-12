import axios from 'axios';
import router from '../../router.js';

const state = {
    loginUser: null,
    loginErrorMessages: null
};

const getters = {
    loginUser: state => state.loginUser,
    loginErrorMessages: state => state.loginErrorMessages
};

const mutations = {
    updateLoginUser(state, newLoginUser) {
        state.loginUser = newLoginUser;
    },
    updateLoginErrorMessages(state, newLoginErrorMessages) {
        state.loginErrorMessages = newLoginErrorMessages;
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

            if(response.data.status == "OK") {
                const newLoginUser = response.data.user;
                commit('updateLoginUser', newLoginUser);

                const jsonNewLoginUser = JSON.stringify(response.data.user);
                localStorage.setItem('loginUserInLocalStorage', jsonNewLoginUser);

                commit('updateLoginErrorMessages', null);

                router.push({
                    name: "TaskIndex"
                });
            } else {
                console.log('Failed');
                const newLoginErrorMessages = response.data.errorMessages;
                commit('updateLoginErrorMessages', newLoginErrorMessages);
            }

        })
        .catch(error => {
            console.log(error);
            const newLoginErrorMessages = ['メールアドレスまたはパスワードが正しくありません。'];
            commit('updateLoginErrorMessages', newLoginErrorMessages);
        });
    },
    logout({ commit }) {
        commit('updateLoginUser', null);
        console.log('ログアウト実行');
        localStorage.removeItem('loginUserInLocalStorage');
        router.replace('/login');
    },
    updateLoginUser({ commit }, updateDataId) {
        axios.post(
            '/api/auth/update',
            {
                updateDataId: updateDataId
            }
        )
        .then(response => {
            console.log(response);
            const newLoginUser = response.data.user;

            commit('updateLoginUser', newLoginUser);

            const jsonNewLoginUser = JSON.stringify(response.data.user);
            localStorage.setItem('loginUserInLocalStorage', jsonNewLoginUser);
/*
            router.push({
                name: "UserIndex"
            });
*/
        });
    }
};

export default {
    state,
    getters,
    mutations,
    actions
}
