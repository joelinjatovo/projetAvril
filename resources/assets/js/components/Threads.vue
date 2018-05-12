<template>
    <div>
        <thread-chat v-for="thread in threads" 
                     :thread="thread" 
                     :key="thread.id">
        </thread-chat>
    </div>
</template>

<script>
    export default {
        props: ['initialThreads', 'user'],

        data() {
            return {
                threads: []
            }
        },

        mounted() {
            this.threads = this.initialThreads;

            Bus.$on('threadCreated', (thread) => {
                console.log(thread);
                this.threads.push(thread);
            });

            this.listenForNewThreads();
        },

        methods: {
            listenForNewThreads() {
                Echo.private('users.' + this.user.id)
                    .listen('ThreadCreated', (e) => {
                        console.log(e);
                        this.threads.push(e.thread);
                    });
            }
        }
    }
</script>
