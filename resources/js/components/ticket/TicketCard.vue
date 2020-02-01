<template>
    <router-link :class="'border-' + getStatus(ticket.status).color"
                 class="d-block card mb-g cursor-pointer border border-4 border-bottom-0 border-top-0 border-right-0"
                 :to="routeToDetail"
    >
        <span class="d-block card-body p-3">
            <span class="d-block mb-2" v-if="hasTerm">
                <small :class="wantedTerm ? 'text-danger' : ''" class="text-muted">
                    <i class="fal fa-stopwatch mr-1"></i>{{termFormatted}}
                </small>
            </span>
            ticket-{{ticket.id}}
            <span class="text-dark">{{ticket.title}}</span>
            <span class="d-flex justify-content-between mt-1">
                <avatar :id="parseInt(ticket.executor_id)" size="sm"/>
                <small class="text-muted" v-if="ticket.comments_count > 0">
                    <i class="fal fa-comment-alt mr-1"></i>{{ticket.comments_count}}
                </small>
            </span>
        </span>
    </router-link>
</template>

<script>
    import statuses from '../../mixins/statuses';
    import Avatar from '../system/Avatar';
    import moment from 'moment';

    export default {
        name: "TicketCard",
        components: {Avatar},
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        computed: {
            wantedTerm() {
                if (this.hasTerm) {
                    let term = moment(this.ticket.term);
                    let now = moment();
                    return term.diff(now, 'days') <= 2;
                }
                return false;
            },
            hasTerm() {
                return this.ticket.term !== null;
            },
            termFormatted() {
                return moment(this.ticket.term).format('D MMMM YYYY');
            },
            routeToDetail() {
                return {
                    name: this.ticket.agile_id === null ? 'show-ticket-default' : 'show-ticket',
                    params: {agileId: this.ticket.agile_id, ticketId: this.ticket.id}
                };
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
