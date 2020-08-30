/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue-icons.min.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'bootstrap/dist/css/bootstrap.css';
import Vue from 'vue';
import VueRouter from "vue-router";
import Vuex from "vuex";
import { isLoggedIn } from './auth.js';
import Notify from './components/alert.vue';
import MainApp from './pages/MainApp.vue';
import { routes } from './routes';
import StoreData from './store';



Vue.use(BootstrapVueIcons)
Vue.use(BootstrapVue);
Vue.use(VueRouter);
Vue.use(Vuex);

Vue.component('notify', Notify);


const router = new VueRouter({
	routes,
	mode: "history"
});

const store = new Vuex.Store(StoreData);
isLoggedIn(router,store)
const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err);
}
window.Vue = require('vue');
const app = new Vue({
	el: '#app',
	router,
	store,
	components: {
			'main-app': MainApp,
	},
});
