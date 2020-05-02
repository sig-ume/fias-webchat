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
const app = new Vue(Vue.util.extend({ router })).$mount('#app'); //
//const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');

const Balloon = {
    template: `<div class="conversation-balloon" :class="speaker">
                <div class="avatar">
                    <img src="https://avatars3.githubusercontent.com/u/15647466?v=3&s=88">
                    <p class="name">{{ name }}</p>
                </div>
                <p class="message">{{ message }}</p>
                </div>`,
    props: {
        name: {
          type: String,
            required: true
        },
        speaker: {
            type: String,
            required: true,
            validator: value => {
                return ['my', 'other'].includes(value);
            }
        },
        message: {
            type: String,
            required: true
        }
    }
};

const ChatForm = {
    template: `<div class="chat-form">
    <div class="form-container">
        <input type="text" class="message" v-model="message">
        <button class="submit" @click="submit">送信</button>
    </div>
    </div>`,
    props: {
        applyEvent: {
        type: String,
        required: true
        }
    },
    data () {
        return {
        message: ''
        }
    },
    methods: {
        submit () {
        this.$emit(this.applyEvent, this.message)
        this.message = '';
        }
    }
};

const app = new Vue({
el: '#app',
components: {
    balloon: Balloon,
    chatForm: ChatForm
},
data () {
    return {
        chatLogs: [
        { name: 'わたしだよ', speaker: 'my', message: 'hello'.repeat(10) },
        { name: 'bot', speaker: 'other', message: 'hello world' }
    ]
    }
},
methods: {
    submit (value) {
    this.chatLogs.push({
        name: 'わたしだよ',
        speaker: 'my',
        message: value
    });
    
    this.botSubmit();
    this.scrollDown();
    },
    botSubmit () {
    setTimeout(() => {
        this.chatLogs.push({
        name: 'bot',
        speaker: 'other',
        message: 'hello world'
        });
        
        this.scrollDown();
    }, 1000);
    },
    scrollDown () {
    const target = this.$el.querySelector('.chat-timeline');
    setTimeout(() => {
        const height = target.scrollHeight - target.offsetHeight;
        target.scrollTop += 10;

        if (height <= target.scrollTop) {
        return;
        } else {
        this.scrollDown();
        }
    }, 0);
    }
}
});