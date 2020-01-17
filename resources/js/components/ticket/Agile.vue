<template>
    <div>
        <div class="row mb-3">
            <div class="col-4" v-for="column in columns">
                <div :class="'border-' + column.color" class="pb-1 border border-left-0 border-right-0 border-top-0" style="border-width: 4px !important;">
                    <h3>{{column.name}}</h3>
                </div>
            </div>
        </div>
        <div v-if="loaded">
            <div class="row">
                <div class="col-4" v-for="(tickets, index) in ticketsFormatted">
                    <transition-group enter-active-class="animated zoomIn" leave-active-class="animated zoomOut">
                        <div :key="ticket.id" @click.prevent="view(ticket.id)" class="card mb-g cursor-pointer" v-for="ticket in tickets">
                            <div class="card-body p-3">
                                <a href="#">ticket-{{ticket.id}}</a> {{ticket.title}}
                            </div>
                        </div>
                    </transition-group>
                    <div v-if='parseInt(index) === 0'>
                        <quick-add @added="added" />
                    </div>
                </div>
            </div>
            <modal :ticket-id="ticketId" id="detail" @updated="updated"/>
        </div>
        <div v-else class="text-center">
            <b-spinner label="Загрузка..." style="width: 8rem; height: 8rem;" type="grow" variant="warning"></b-spinner>
        </div>
    </div>
</template>

<script>
    import Modal from './Modal';
    import QuickAdd from './QuickAdd';
    export default {
        name: "Agile",
        components: {QuickAdd, Modal},
        data() {
            return {
                columns: [
                    {name: 'В очереди', color: 'secondary'},
                    {name: 'В работе', color: 'warning'},
                    {name: 'Выполнено', color: 'success'}
                ],
                tickets: [],
                ticketId: null,
                loaded: false
            };
        },
        created() {
            this.fetch();
        },
        computed: {
            ticketsFormatted: function() {
                let result = {};
                for (let i = 0; i < this.columns.length; i++) {
                    result[i] = [];
                }
                for (let i = 0; i < this.tickets.length; i++) {
                    let column = this.getColumnByStatus(this.tickets[i].status);
                    if (column === -1) {
                        continue;
                    }
                    if (typeof result[column] === 'undefined') {
                        result[column] = [];
                    }
                    result[column].push(this.tickets[i]);
                }
                return result;
            }
        },
        methods: {
            getTicketKey(id) {
                for (let i = 0; i < this.tickets.length; i++) {
                    if (this.tickets[i].id === id) {
                        return i;
                    }
                }
                return null;
            },
            getColumnByStatus(status) {
                switch (status) {
                    case 100:
                        return 0;
                    case 200:
                    case 300:
                        return 1;
                    case 400:
                        return 2;
                }
                return -1;
            },
            fetch() {
                axios.get('ticket').then(response => {
                    this.tickets = response.data;
                    this.loaded = true;
                });
            },
            view(id) {
                this.ticketId = id;
                this.$bvModal.show('detail');
            },
            added(ticket) {
                this.tickets.push(ticket);
            },
            updated(ticket) {
                let key = this.getTicketKey(ticket.id);
                if (key !== -1) {
                    this.$set(this.tickets, key, ticket);
                }
            }
        }
    }
</script>

<style scoped>

</style>
