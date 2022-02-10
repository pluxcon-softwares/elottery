import Vue from 'vue';
import Vuex from 'vuex';
import user from './modules/user';
import lottery from './modules/lottery';
import result from './modules/result';
import chart from './modules/chart';
//import modules from './_module_registration';

Vue.use(Vuex);

export default new Vuex.Store({
    //modules
    modules:{
        user,
        lottery,
        result,
        chart,
    }
});
