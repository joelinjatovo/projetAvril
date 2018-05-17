<template>
    <ul  class="list-group">
        <user-item v-for="user in initialUsers"
             :user="user"
             :key="user.id">
        </user-item>
    </ul>
</template>

<script>
    export default {
        props: ['initialUsers'],
    }
</script>
