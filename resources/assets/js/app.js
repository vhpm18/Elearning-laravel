/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.$http = axios;

/*Uso de vue-resource*/
import VueResource from 'vue-resource'
Vue.use(VueResource)


/*Uso de vue-tables-2*/
import { ServerTable } from 'vue-tables-2';
Vue.use(ServerTable, {}, false, 'bootstrap4', 'default');

import StripeForm from './components/StripeForm';
Vue.component('stripe-form', StripeForm);

import Courses from './components/Courses';
Vue.component('couses-list', Courses);

import Students from './components/Students';
Vue.component('students-list', Students);

import Teachers from './components/Teachers';
Vue.component('teachers-list', Teachers);

const app = new Vue({
    el: '#app'
});
