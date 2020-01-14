export default {
    methods: {
        user(id) {
            if (typeof this.$store.state.users[id] === 'undefined') {
                return  {name: 'Undefined'};
            }
            return this.$store.state.users[id];
        }
    }
}
