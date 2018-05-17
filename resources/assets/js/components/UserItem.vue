<template>
    <li class="list-group-item clearfix">
        <div class="pull-left">
            <a @click.prevent="createThread">{{user.name}}</a>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                user_id: this.user.id,
                seen: true
            }
        },

        methods: {
            createThread() {
                axios.post('/chat/threads', {user_id: this.user_id})
                .then((response) => {
                    this.user_id = '';
                    this.seen = false;
                    Bus.$emit('threadCreated', response.data);
                });
            }
        }
    }
</script>
