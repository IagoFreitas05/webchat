import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        user:{}
    },
    mutations:{
        setUserState:(state, value) => state.user = value
    },
    actions:{
        userStateAction: ({commit :commit})=>{
            axios.get('api/users/me').then(response =>{
                const userResponse = response.data.user;
                commit('setUserState', userResponse);
            })
        }
    },
    plugins: [createPersistedState()]
})
