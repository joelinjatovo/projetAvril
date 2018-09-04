

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
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        // Show notification count
        var len = notifications.length;
        if(len<10){
            $(target+"-count").html(len);
        }else{
            $(target+"-count").html("9+");
        }
        
        // show only last 5 notifications
        notifications.slice(0, 10);
        
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target).html(htmlElements.join(''));
    } else {
        $(target+"-count").html(0);
        $(target).html('<li><a href="#">0 notification non lue</a></li>');
    }
}

// Make a single notification string
function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '"><i class="fa fa-users text-aqua"></i> ' + notificationText + '</a></li>';
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '?read=' + notification.id;
    if(notification.type === NOTIFICATION_TYPES.mail) {
        to = Laravel.role + '/mail/'+notification.data.data.mail_id + to;
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


  
