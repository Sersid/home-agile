<template>
    <div class="panel">
        <div class="panel-hdr">
            <h2>Новые тикеты</h2>
            <div class="panel-toolbar">
                <span class="spinner-border spinner-border-sm" v-if="showTicketsLoader"><span class="sr-only">Загрузка...</span></span>
            </div>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <quick-add @added="add" />
                <div class="list-group">
                    <a
                            :key="ticket.id"
                            @click.prevent="view(ticket.id)"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            href="#"
                            v-for="ticket in tickets">
                        <span>{{ ticket.title }}</span>
                    </a>
                </div>
                <modal :ticket-id="ticketId" id="detail"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Modal from './Modal'
    import QuickAdd from './QuickAdd';

    export default {
        name: "Wishes",
        components: {Modal, QuickAdd},
        props: {
            timer: {
                type: Number,
                default: 60000
            }
        },
        data() {
            return {
                tickets: Array,
                showTicketsLoader: true,
                showModal: false,
                ticketId: null,
                interval: ''
            }
        },
        created() {
            this.fetch();
            if (this.timer > 0) {
                this.interval = setInterval(this.fetch, this.timer);
            }
        },
        methods: {
            fetch() {
                axios.get('ticket/last').then(response => {
                    this.tickets = response.data.data;
                }).finally(() => {
                    this.showTicketsLoader = false;
                });
            },
            add(ticket) {
                this.tickets.unshift(ticket);
            },
            view(id) {
                this.ticketId = id;
                this.$bvModal.show('detail');
            }
        },
        beforeDestroy() {
            clearInterval(this.interval);
        }
    }
</script>
