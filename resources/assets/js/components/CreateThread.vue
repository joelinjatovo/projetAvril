<template>
    <div class="panel panel-default">
        <div class="panel-heading">Create Group</div>
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <select v-model="user_id" id="friends">
                        <option v-for="user in initialUsers" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div class="panel-footer text-center">
            <button type="submit" @click.prevent="createThread" class="btn btn-primary">Contact This user</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['initialUsers'],

        data() {
            return {
                user_id: ''
            }
        },

        methods: {
            createThread() {
                axios.post('/thread/threads', {user_id: this.user_id})
                .then((response) => {
                    this.user_id = '';
                    Bus.$emit('threadCreated', response.data);
                });
            }
        }
    }
</script>
