

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
Vue.component('user-item', require('./components/UserItem.vue'));
Vue.component('users', require('./components/Users.vue'));
Vue.component('comment', require('./components/Comments.vue'));

const app = new Vue({
    el: '#app'
});

var notifications = [];
const NOTIFICATION_TYPES = {
    test: 'App\\Notifications\\Order',
    mail: 'App\\Notifications\\NewMail',
    order: 'App\\Notifications\\NewOrder',
    purchase: 'App\\Notifications\\OrderPaid',
};

$(document).ready(function() {
    // check if there's a logged in user
    if(Laravel.userId) {
        $.get('/notifications', function (data) {
                console.log(data);
            addNotifications(data, "#notifications");
        });
        
        window.Echo.private(`App.Models.User.${Laravel.userId}`)
            .notification((notification) => {
                console.log(notification);
                addNotifications([notification], '#notifications');
            });
    }
});

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications');
        $(target + 'Count').removeClass('hidden');
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
        $(target + 'Count').addClass('hidden');
    }
}

// Make a single notification string
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '">' + notificationText + '</a></li>';
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if(notification.type === NOTIFICATION_TYPES.mail) {
        to = 'mails' + to;
    }
    return '/' + to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if(notification.data.message != undefined){
        text += notification.data.message;
    }
    else{
        text += notification.data.data.message;
    }
    return text;
}

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
