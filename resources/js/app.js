require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import router from './routes/router';
import store from './store/index';
import PrimeVue from 'primevue/config';

Vue.use(VueRouter);
Vue.use(PrimeVue);

const user = new Vue({
    el: '#app',
    router,
    store
});
