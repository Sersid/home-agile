<template>
    <div>
        <quick-add @added="added"/>
        <div class="row mb-3 mt-5">
            <div class="col-4" v-for="column in columns">
                <div :class="'border-' + column.color" class="pb-1 border border-left-0 border-right-0 border-top-0 border-4">
                    <h3>{{column.name}}</h3>
                </div>
            </div>
        </div>
        <div v-if="loaded">
            <div class="row">
                <div class="col-lg-4" v-for="(tickets, index) in ticketsFormatted">
                    <transition-group enter-active-class="animated zoomIn" leave-active-class="animated zoomOut">
                        <div :key="ticket.id" @click.prevent="view(ticket.id)" class="card mb-g cursor-pointer border border-4 border-bottom-0 border-top-0 border-right-0" :class="'border-' + getStatus(ticket.status).color" v-for="ticket in tickets">
                            <div class="card-body p-3">
                                <a href="#">ticket-{{ticket.id}}</a> {{ticket.title}}
                            </div>
                        </div>
                    </transition-group>
                </div>
            </div>
            <modal :ticket-id="ticketId" @updated="updated" id="detail"/>
        </div>
        <div class="text-center" v-else>
            <b-spinner label="Загрузка..." style="width: 8rem; height: 8rem;" type="grow" variant="warning"></b-spinner>
        </div>
    </div>
</template>

<script>
    import Modal from './Modal';
    import QuickAdd from './QuickAdd';
    import statuses from '../../mixins/statuses';

    export default {
        name: "Agile",
        components: {QuickAdd, Modal},
        mixins: [statuses],
        data() {
            return {
                columns: [
                    {name: 'Новые', color: 'info'},
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
                let result = [];
                for (let i = 0; i < this.columns.length; i++) {
                    result[i] = [];
                }
                for (let i = 0; i < this.tickets.length; i++) {
                    let column = this.getColumnByStatus(this.tickets[i].status);
                    if (column === -1) {
                        continue;
                    }
                    result[column].push(this.tickets[i]);
                }
                for (let i = 0; i < result.length; i++) {
                    result[i].sort(function(a, b) {
                        if (a.priority > b.priority) {
                            return -1;
                        } else if (a.priority === b.priority) {
                            if (a.id < b.id) {
                                return -1;
                            }
                            return 0;
                        } else {
                            return 1;
                        }
                    });
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
