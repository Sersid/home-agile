export default {
    methods: {
        getUser(id) {
            if (typeof this.users[id] === 'undefined') {
                return {name: '', avatar: '/upload/avatars/no-avatar.png', sex: 1};
            }
            return this.users[id];
        },
        isMale(id) {
            return this.getUser(id).sex === 1;
        }
    },
    computed: {
        users() {
            return this.$store.state.users;
        }
    }
}
