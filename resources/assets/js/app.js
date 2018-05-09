

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Bus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('threads', require('./components/Threads.vue'));
Vue.component('create-thread', require('./components/CreateThread.vue'));
Vue.component('thread-chat', require('./components/ThreadChat.vue'));

const app = new Vue({
    el: '#app'
});

/*
require('./bootstrap');

window.Vue = require('vue');

Vue.component('chat-messages', require('./components/ChatMessage.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        threads: []
    },

    created() {
        this.fetchMessages();
        this.listenForNewThreads();
        this.listenForNewMessage();
        
    },

    methods: {
        fetchMessages() {
            axios.get('/chat/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/chat/messages', message).then(response => {
              console.log(response.data);
            });
        },
        
        listenForNewThreads() {
            Echo.private('users.' + this.user.id)
                .listen('ThreadCreated', (e) => {
                    this.threads.push(e.thread);
                });
        },
        
        listenForNewMessage() {
            Echo.private('groups.' + this.group.id)
                .listen('NewMessage', (e) => {
                    this.messages.push(e);
                });
        },
        
        listenForNewChat() {
            Echo.private('chat')
                .listen('MessageSent', (e) => {
                    this.messages.push({
                      message: e.message.message,
                      user: e.user
                    });
              });
        }
    }
});
*/
