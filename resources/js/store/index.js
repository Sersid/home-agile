import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        users: [],
        statuses: {},
        priorities: {},
    },
    getters: {
        USERS: state => {
            return state.users;
        },
        STATUSES: state => {
            return state.statuses;
        },
        PRIORITIES: state => {
            return state.priorities;
        }
    },
    mutations: {
        SET_USERS: (state, payload) => {
            state.users = payload;
        },
        SET_STATUSES: (state, payload) => {
            state.statuses = payload;
        },
        SET_PRIORITIES: (state, payload) => {
            state.priorities = payload;
        }
    }
});
