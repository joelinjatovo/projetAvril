<template>
    <div class="panel panel-primary">
        <div class="panel-heading" id="accordion">
            <span class="glyphicon glyphicon-comment"></span> {{thread.userone.name}} {{thread.usertwo.name}}
            <div class="btn-group pull-right">
                <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion-" :href="'#collapseOne-' + thread.id">
                    <span class="glyphicon glyphicon-chevron-down"></span>
                </a>
            </div>
        </div>
        <div class="panel-collapse collapse" :id="'collapseOne-' + thread.id">
            <div class="panel-body chat-panel">
                <ul class="chat">
                    <li v-for="message in messages">
                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font">{{ message.id }}</strong>
                            </div>
                            <p>
                                {{ message.message }}
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." v-model="message" @keyup.enter="store()" autofocus />
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-sm" id="btn-chat" @click.prevent="store()">
                            Send</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['thread'],

        data() {
            return {
                messages: [],
                message: '',
                thread_id: this.thread.id
            }
        },

        mounted() {
            this.listenForNewMessage();
        },

        methods: {
            store() {
                axios.post('/chat/messages', {message: this.message, thread_id: this.thread.id})
                .then((response) => {
                    this.message = '';
                    console.log(response);
                    this.messages.push(response.data);
                });
            },

            listenForNewMessage() {
                Echo.private('threads.' + this.thread.id)
                    .listen('MessageSent', (e) => {
                        console.log('MessageSent');
                        console.log(e);
                        this.messages.push(e.message);
                });
            }
        }
    }
</script>
