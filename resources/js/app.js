/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from "vue-router";
import Vuex from "vuex";
import { routes } from './routes';
import MainApp from './pages/MainApp.vue';
import Notify from './components/alert.vue';
import StoreData from './store';
import { BootstrapVue } from 'bootstrap-vue'
import { isLoggedIn } from './auth.js';

// import vuetify from './plugins/vuetify'
// Install BootstrapVue

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// import 'material-design-icons-iconfont/dist/material-design-icons.css'

Vue.use(BootstrapVue)
Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component('notify', Notify)

const router = new VueRouter({
    routes,
    mode: "history"
});

const store = new Vuex.Store(StoreData);

window.Vue = require('vue');
isLoggedIn(router,store)
const app = new Vue({
    el: '#app',
	router,
	store,
	// vuetify,
    components: {
		'main-app': MainApp
}
});
