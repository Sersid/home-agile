<template>
    <b-dropdown :text="agile.title" variant="outline-default">
        <b-dropdown-item @click.prevent="save(null)" href="#">
            <span v-if="null === data.agile_id">&blacktriangleright;</span>
            <span>Основная доска</span>
        </b-dropdown-item>
        <b-dropdown-item @click.prevent="save(agile.id)" href="#" v-for="agile in agiles" :key="agile.id">
            <span v-if="parseInt(agile.id) === data.agile_id">&blacktriangleright;</span>
            <span>{{agile.title}}</span>
        </b-dropdown-item>
    </b-dropdown>
</template>

<script>
    import agiles from '../../mixins/agiles';

    export default {
        name: "AgileChanger",
        mixins: [agiles],
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                data: Object
            };
        },
        computed: {
            agile() {
                return this.getAgile(this.data.agile_id)
            }
        },
        created() {
            this.data = this.ticket;
        },
        methods: {
            save(agile) {
                this.$set(this.data, 'agile_id', agile);
                this.$emit('process', true);
                axios.patch('ticket/agile/' + this.data.id, {agile_id: this.data.agile_id})
                    .then(response => {
                        this.$emit('saved', response.data);
                    })
                    .finally(() => {
                        this.$emit('process', false);
                    });
            }
        }
    }
</script>
