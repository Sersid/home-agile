import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        users: []
    },
    getters: {
        USERS: state => {
            return state.users;
        }
    },
    mutations: {
        SET_USERS: (state, payload) => {
            state.users = payload;
        }
    }
});
