<template>
    <a v-b-tooltip.hover :title="isWatch ? 'Подписаться на тикет' : 'Отписаться от тикета'" href="#" class="fa-star" :class="isWatch ? 'fas text-warning' : 'far text-muted'" @click.prevent="change"/>
</template>

<script>
    export default {
        name: "Watcher",
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        computed: {
            isWatch() {
                return this.ticket.is_watch;
            }
        },
        methods: {
            change() {
                this.$emit('process', true);
                axios.post('/ticket/' + (this.isWatch ? 'unwatch' : 'watch'), {ticket_id: this.ticket.id})
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

<style scoped>

</style>
