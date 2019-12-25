<template>
    <div>
        <div class="panel-tag">
            Добавь свое желание и оно обязательно сбудется :)
        </div>
        <form @submit.prevent="add">
            <div class="input-group mb-3">
                <input type="text"
                       autofocus
                       placeholder="Я хочу..."
                       class="form-control form-control-lg"
                       v-model="name"
                       @input="$v.name.$touch()"
                       :disabled="showButtonLoader"
                       :class="{'is-invalid':  $v.name.$error}"
                >
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary" :disabled="showButtonLoader">
                        <b-spinner v-if="showButtonLoader" small label="Загрузка..."></b-spinner>
                        Добавить
                    </button>
                </div>
            </div>
            <b-alert variant="danger" v-if="!$v.name.required">Напиши хоть что-нибудь :(</b-alert>
            <b-alert variant="danger" v-if="errors.length > 0">
                <div v-for="error in errors">{{error.message}}</div>
            </b-alert>
        </form>
        <div class="list-group">
            <span v-if="showTicketsLoader" class="list-group-item list-group-item-action align-items-center text-center">
                <span class="spinner-border spinner-border-sm"><span class="sr-only">Загрузка...</span></span>
            </span>
            <a
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                v-for="ticket in tickets"
                :key="ticket.id"
                @click.prevent="view(ticket.id)"
                href="#">
                <span>{{ ticket.name }}</span>
                <user :id="ticket.created_user_id"/>
            </a>
        </div>
        <modal id="detail" :ticket-id="ticketId" />
    </div>
</template>

<script>
    import User from '../User'
    import Modal from './Modal'
    import {required} from 'vuelidate/lib/validators'

    export default {
        name: "Wishes",
        components: {User, Modal},
        props: {
            timer: {
                type: Number,
                default: 60000
            }
        },
        data() {
            return {
                tickets: Array,
                name: '',
                showButtonLoader: false,
                showTicketsLoader: true,
                showModal: false,
                ticketId: null,
                errors: [],
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
                axios.get('wishes').then(response => {
                    this.tickets = response.data;
                }).finally(() => {
                    this.showTicketsLoader = false;
                });
            },
            add() {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.showButtonLoader = true;
                    this.errors = [];
                    axios.post('wishes', {name: this.name})
                        .then(response => {
                            this.tickets.unshift(response.data);
                            this.name = '';
                            this.$v.$reset();
                        })
                        .catch(e => {
                            this.errors = e.response.data;
                        })
                        .finally(() => {
                            this.showButtonLoader = false;
                        });
                }
            },
            view(id) {
                this.ticketId = id;
                this.$bvModal.show('detail');
            }
        },
        validations: {
            name: {
                required
            }
        },
        beforeDestroy() {
            clearInterval(this.interval);
        }
    }
</script>
