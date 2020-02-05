<template>
    <b-dropdown :text="status.name" block right :variant="'outline-' + status.color">
        <b-dropdown-item :key="index" @click.prevent="save(index)" href="#" v-for="(s, index) in statuses">
            <span v-if="parseInt(index) === data.status">&blacktriangleright;</span>
            <span :class="'text-' + s.color">{{s.name}}</span>
        </b-dropdown-item>
    </b-dropdown>
</template>

<script>
    import statuses from '../../mixins/statuses';

    export default {
        name: "StatusChanger",
        mixins: [statuses],
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
            status() {
                return this.getStatus(this.data.status)
            }
        },
        created() {
            this.data = this.ticket;
        },
        methods: {
            save(status) {
                this.$set(this.data, 'status', parseInt(status));
                this.$emit('process', true);
                axios.patch('ticket/status/' + this.data.id, {status: this.data.status})
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
