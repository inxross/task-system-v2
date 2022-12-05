import axios from 'axios';

const state = {
    isAuth: false,
    user: null,
};

const getters = {
    isAuth: state => state.isAuth,
    user: state => state.user,
};

const mutations = {
    SET_IS_AUTH(state, value) {
        state.isAuth = value;
    },
    SET_USER(state, value) {
        state.user = value;
    },
};

const actions = {
    async login({ dispatch }, credentials) {
        await axios.get('/sanctum/csrf-cookie');
        await axios.post('/api/auth/login', credentials);
        return await dispatch('me');
    },
    async me({ commit }) {
        return await axios
            .get('/api/user')
            .then(response => {
            commit('SET_IS_AUTH', true);
            commit('SET_USER', response.data);
            })
            .catch(() => {
            commit('SET_IS_AUTH', false);
            commit('SET_USER', null);
            });
    },
};

export default {
    state,
    getters,
    mutations,
    actions
}
