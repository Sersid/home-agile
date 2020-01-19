export default {
    methods: {
        getUser(id) {
            if (typeof this.users[id] === 'undefined') {
                return  {name: '', avatar: '/upload/avatars/no-avatar.png'};
            }
            return this.users[id];
        }
    },
    computed: {
        users() {
            return this.$store.state.users;
        }
    }
}
