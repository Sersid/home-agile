<template>
    <div :class="'border-' + getStatus(ticket.status).color" class="card mb-g cursor-pointer border border-4 border-bottom-0 border-top-0 border-right-0" @click="show(ticket.id)">
        <div class="card-body p-3">
            <span class="text-primary">ticket-{{ticket.id}}</span> {{ticket.title}}
            <div class="d-flex">

            </div>
        </div>
    </div>
</template>

<script>
    import statuses from '../../mixins/statuses';

    export default {
        name: "TicketCard",
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        mixins: [statuses],
        methods: {
            show(id) {
                this.$emit('show', id);
            }
        }
    }
</script>

<style scoped>

</style>
