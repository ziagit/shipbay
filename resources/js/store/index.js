// store/index.js

import Vue from "vue";
import Vuex from "vuex";
import auth from './auth';
import shared from './shared';
import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

export default new Vuex.Store({

    plugins: [createPersistedState({
        storage: window.sessionStorage,
        paths: ['shared']
    })],
    state: {

    },
    getters: {

    },

    mutations: {

    },
    actions: {},
    modules: {
        auth,
        shared
    }
});