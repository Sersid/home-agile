export default {
    methods: {
        getPriority(id) {
            if (typeof this.priorities[id] === 'undefined') {
                return {name: 'Undefined', color: 'default'};
            }
            return this.priorities[id];
        }
    },
    computed: {
        priorities() {
            return this.$store.state.priorities;
        }
    }
}
