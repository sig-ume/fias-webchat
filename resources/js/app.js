/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Single Page Application用に追加
 */
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './App.vue';
Vue.use(VueAxios, axios);

/**
 * Single Page Application ルーティング
 */
import LobbyComponent from './components/LobbyComponent.vue';
import ChatComponent from './components/ChatComponent.vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const routes = [
     {
         name: 'lobby',
         path: '/lobby',
         component: LobbyComponent
     },
     {
         name: 'chatspa',
         path: '/chatspa',
         component: ChatComponent
     }
    ];
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 * 
 * Single Page Application用に足したり消したり
 */

// const app = new Vue({
//     el: '#app',
// });

//const router = new VueRouter({ mode: 'history'});
const router = new VueRouter({ mode: 'history', routes: routes});
//const app = new Vue(Vue.util.extend({ router })).$mount('#app');
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');