<template>
    <div>
        <input :value="dateValue" @input="save($event.target.value)" class="form-control" type="date" v-if="show"/>
        <div @click="showInput" class="pt-2 cursor-pointer" v-else>
            <i class="fal fa-calendar-alt mr-1"></i>
            <span v-if="hasDate">{{dateFormatted}}</span>
            <span class="text-muted" v-else>не указан</span>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: "TermChanger",
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                show: false,
                date: ''
            };
        },
        created() {
            this.date = this.ticket.term;
        },
        computed: {
            hasDate() {
                return this.date !== null && this.date.length > 0;
            },
            dateFormatted() {
                return moment(this.date).format('D MMMM YYYY');
            },
            dateValue() {
                return this.hasDate ? moment(this.date).format('YYYY-MM-DD') : ''
            }
        },
        methods: {
            showInput() {
                this.show = true;
            },
            save(value) {
                this.show = false;
                this.date = value;
                this.$emit('process', true);
                axios.patch('ticket/term/' + this.ticket.id, {term: this.date})
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
