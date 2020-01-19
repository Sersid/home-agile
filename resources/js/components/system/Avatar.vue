<template>
    <img class="rounded-circle" :class="className" :src="user.avatar" :alt="user.name" />
</template>

<script>
    import users from '../../mixins/users';
    export default {
        name: "Avatar",
        props: {
            id: {
                type: Number,
                required: true
            },
            size: {
                type: String,
                required: false,
            }
        },
        mixins: [users],
        computed: {
            user() {
                return this.getUser(this.id);
            },
            className() {
                return 'profile-image' + (typeof this.size !== 'undefined' ? '-' + this.size : '');
            }
        }
    }
</script>

<style scoped>

</style>
