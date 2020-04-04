window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'

require('./bootstrap')

Vue.use(VueRouter)

Vue.component('vue-header', require('./components/Layouts/Header.vue'))

 const router = new VueRouter({
     mode: 'history',
     routes: [
         { path: '/books', component: require('./components/Books/Index.vue') },
         { path: '/books/:id', component: require('./components/Books/Show.vue') },
     ]
 })

 const app = new Vue({
     router,
     el: '#app'
 })

