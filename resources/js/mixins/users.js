export default {
    methods: {
        getUser(id) {
            if (typeof this.users[id] === 'undefined') {
                return  {name: ''};
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
