<template>
    <div class="d-flex">
        <button class="btn btn-icon fs-lg mr-2 active" type="button" @click="show = !show">
            <i class="fal fa-calendar-alt"></i>
        </button>
        <datepicker v-if="show" :language="ru" input-class="form-control" v-model="date" format="dd MMM yyyy" />
        <span v-else class="pt-2">
            <span v-if="hasTerm">{{dateFormatted}}</span>
            <span v-else class="text-muted">не указан</span>
        </span>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import {ru} from 'vuejs-datepicker/dist/locale'
    import moment from 'moment';

    export default {
        name: "TermChanger",
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        components: {Datepicker},
        data() {
            return {
                data: Object,
                ru: ru,
                show: false,
                date: ''
            };
        },
        created() {
            this.data = this.ticket;
        },
        computed: {
            hasTerm() {
                return this.data.term !== null;
            },
            dateFormatted() {
                return moment(this.data.term).format('D MMMM YYYY');
            },
        },
        watch: {
            date(date) {
                this.$set(this.data, 'term', date);
                this.show = false;
                this.$emit('process', true);
                axios.patch('ticket/term/' + this.data.id, {term: date})
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
