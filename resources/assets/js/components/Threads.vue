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

            Bus.$on('threadCreated', (e) => {
                console.log('threadCreated');
                console.log(e);
                if(e.state){
                    this.threads.push(e.data);
                }
            });

            this.listenForNewThreads();
        },

        methods: {
            listenForNewThreads() {
                Echo.private('users.' + this.user.id)
                    .listen('ThreadCreated', (e) => {
                        console.log("listen('ThreadCreated')");
                        console.log(e);
                        if(e.state){
                            this.threads.push(e.data.thread);
                        }
                        
                    });
            }
        }
    }
</script>
