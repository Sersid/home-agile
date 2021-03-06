/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate';
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import store from './store'
import App from './App.vue'
import Agile from './components/ticket/Agile';

Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(BootstrapVue);

let router = new VueRouter({
    routes: [
        {path: '/', component: Agile},
        {
            path: '/agile',
            name: 'agile-default',
            component: Agile,
            children: [
                {
                    name: 'show-ticket-default',
                    path: 'ticket-:ticketId',
                    component: Agile
                }
            ]
        },
        {
            path: '/agile-:agileId',
            name: 'agile',
            component: Agile,
            children: [
                {
                    name: 'show-ticket',
                    path: 'ticket-:ticketId',
                    component: Agile
                }
            ]
        },
    ]
});

new Vue({
    el: '#app',
    router: router,
    store,
    render: h => h(App)
});
