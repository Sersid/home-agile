<template>
    <b-dropdown :text="priority.name" block right :variant="'outline-' + priority.color">
        <b-dropdown-item :key="index" @click.prevent="save(index)" href="#" v-for="(p, index) in priorities">
            <span v-if="parseInt(index) === data.priority">&blacktriangleright;</span>
            <span :class="'text-' + p.color">{{p.name}}</span>
        </b-dropdown-item>
    </b-dropdown>
</template>

<script>
    import priorities from '../../mixins/priorities';

    export default {
        name: "PriorityChanger",
        mixins: [priorities],
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
            priority() {
                return this.getPriority(this.data.priority)
            }
        },
        created() {
            this.data = this.ticket;
        },
        methods: {
            save(priority) {
                this.$set(this.data, 'priority', parseInt(priority));
                this.$emit('process', true);
                axios.patch('ticket/priority/' + this.data.id, {priority: this.data.priority})
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
