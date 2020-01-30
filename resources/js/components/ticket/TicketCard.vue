<template>
    <div :class="'border-' + getStatus(ticket.status).color" class="card mb-g cursor-pointer border border-4 border-bottom-0 border-top-0 border-right-0" @click="show(ticket.id)">
        <div class="card-body p-3">
            <div class="mb-2" v-if="hasTerm">
                <small class="text-muted" :class="wantedTerm ? 'text-danger' : ''"><span class="fal fa-calendar-alt mr-1"></span>{{termFormatted}}</small>
            </div>
            <span class="text-primary">ticket-{{ticket.id}}</span> {{ticket.title}}
            <div class="d-flex justify-content-between mt-1">
                <div>
                    <avatar :id="parseInt(ticket.executor_id)" size="sm" />
                </div>
                <div>
                    <small class="text-muted" v-if="ticket.comments_count > 0"><span class="fal fa-comment-alt mr-1"></span>{{ticket.comments_count}}</small>
                </div>
            </div>
        </div>
    </div>
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
