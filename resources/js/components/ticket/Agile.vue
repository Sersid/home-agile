<template>
    <div>
        <div class="subheader">
            <h1 class="subheader-title">{{getAgile(agileId).title}}</h1>
        </div>
        <quick-add :agile-id="agileId" @added="added"/>
        <div class="mb-3 mt-5 hidden-lg-up">
            <ul class="nav nav-tabs nav-tabs-clean nav-fill">
                <li :class="[activeTab === index ? '' : 'border-bottom-0', 'border-' + column.color]" @click="showColumn(index)" class="nav-item border border-2 border-left-0 border-right-0 border-top-0" v-for="(column, index) in columns">
                    {{column.name}}
                </li>
            </ul>
        </div>
        <div class="row mb-3 mt-5 hidden-xs-down">
            <div class="col-4" v-for="column in columns">
                <div :class="'border-' + column.color" class="pb-1 border border-left-0 border-right-0 border-top-0 border-4">
                    <h3>{{column.name}}</h3>
                </div>
            </div>
        </div>
        <div v-if="loaded">
            <div class="row hidden-lg-up">
                <div :key="index" class="col-lg-4" v-for="(tickets, index) in ticketsFormatted" v-show="index === activeTab">
                    <transition-group enter-active-class="animated zoomIn" leave-active-class="animated zoomOut">
                        <ticket-card :key="ticket.id" :ticket="ticket" v-for="ticket in tickets"/>
                    </transition-group>
                </div>
            </div>
            <div class="row hidden-xs-down">
                <div class="col-lg-4" v-for="tickets in ticketsFormatted">
                    <transition-group enter-active-class="animated zoomIn" leave-active-class="animated zoomOut">
                        <ticket-card :key="ticket.id" :ticket="ticket" v-for="ticket in tickets"/>
                    </transition-group>
                </div>
            </div>
        </div>
        <div class="text-center" v-else>
            <b-spinner label="Загрузка..." style="width: 8rem; height: 8rem;" type="grow" variant="warning"></b-spinner>
        </div>
        <modal :ticket-id="ticketId" @addedComment="addedComment" @updated="updated" id="detail"/>
    </div>
</template>

<script>
    import Modal from './Modal';
    import QuickAdd from './QuickAdd';
    import TicketCard from './TicketCard';
    import agiles from '../../mixins/agiles';

    export default {
        name: "Agile",
        components: {QuickAdd, TicketCard, Modal},
        mixins: [agiles],
        data() {
            return {
                columns: [
                    {name: 'Новые', color: 'info'},
                    {name: 'В работе', color: 'warning'},
                    {name: 'Выполнено', color: 'success'}
                ],
                agileId: Number,
                tickets: [],
                ticketId: null,
                loaded: false,
                activeTab: 0,
            };
        },
        created() {
            this.route();
        },
        watch: {
            $route: 'route',
            agileId() {
                this.loaded = false;
                axios.get('ticket', {params: {id: this.agileId}}).then(response => {
                    this.tickets = response.data;
                    this.loaded = true;
                });
            },
            ticketId() {
                if (this.ticketId !== null) {
                    this.$bvModal.show('detail');
                } else {
                    this.$bvModal.hide('detail');
                }
            }
        },
        computed: {
            ticketsFormatted() {
                let result = [];
                for (let i = 0; i < this.columns.length; i++) {
                    result[i] = [];
                }
                for (let i = 0; i < this.tickets.length; i++) {
                    let ticket = this.tickets[i];
                    if (ticket.agile_id !== this.agileId) {
                        continue;
                    }
                    let column = this.getColumnByStatus(ticket.status);
                    if (column === -1) {
                        continue;
                    }
                    result[column].push(ticket);
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
            showColumn(index) {
                this.activeTab = index;
            },
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
            route() {
                this.agileId = typeof this.$route.params.agileId !== 'undefined' && this.$route.params.agileId !== null
                               ? parseInt(this.$route.params.agileId)
                               : null;
                this.ticketId = typeof this.$route.params.ticketId !== 'undefined' && this.$route.params.ticketId !== null
                               ? parseInt(this.$route.params.ticketId)
                               : null;
            },
            added(ticket) {
                this.tickets.push(ticket);
                this.$router.push({
                    name: ticket.agile_id !== null ? 'show-ticket' : 'show-ticket-default',
                    params: { agileId: ticket.agile_id, ticketId: ticket.id }
                });
            },
            updated(ticket) {
                let key = this.getTicketKey(ticket.id);
                if (key !== -1) {
                    this.$set(this.tickets, key, ticket);
                }
            },
            addedComment(id) {
                let key = this.getTicketKey(id);
                if (key !== -1) {
                    this.$set(this.tickets[key], 'comments_count', this.tickets[key].comments_count + 1);
                }
            }
        }
    }
</script>

<style scoped>

</style>
