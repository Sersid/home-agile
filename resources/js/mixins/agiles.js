export default {
    methods: {
        getAgile(id) {
            if (typeof this.agiles[id] === 'undefined') {
                return  {title: 'Основная доска'};
            }
            return this.agiles[id];
        }
    },
    computed: {
        agiles() {
            return this.$store.state.agiles;
        }
    }
}
