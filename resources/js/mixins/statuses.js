export default {
    methods: {
        getStatus(id) {
            if (typeof this.statuses[id] === 'undefined') {
                return {name: 'Undefined', color: 'default'};
            }
            return this.statuses[id];
        }
    },
    computed: {
        statuses() {
            return this.$store.state.statuses;
        }
    }
}
