<template>
    <div class="panel">
        <div class="panel-hdr">
            <h2>Новые тикеты</h2>
            <div class="panel-toolbar">
                <span v-if="showTicketsLoader" class="spinner-border spinner-border-sm"><span class="sr-only">Загрузка...</span></span>
            </div>
        </div>
        <div class="panel-container">
            <div class="panel-content">
                <div class="panel-tag">
                    Добавь свое желание и оно обязательно сбудется :)
                </div>
                <form @submit.prevent="add">
                    <div class="input-group mb-3">
                        <input :class="{'is-invalid':  $v.title.$error}"
                               :disabled="showButtonLoader"
                               @input="$v.title.$touch()"
                               autofocus
                               class="form-control form-control-lg"
                               placeholder="Я хочу..."
                               type="text"
                               v-model="title"
                        >
                        <div class="input-group-append">
                            <button :disabled="showButtonLoader" class="btn btn-primary" type="submit">
                                <b-spinner label="Загрузка..." small v-if="showButtonLoader"></b-spinner>
                                Добавить
                            </button>
                        </div>
                    </div>
                    <div v-if="$v.title.$error" class="alert alert-danger   " role="alert">
                        Напиши хоть что-нибудь :(
                    </div>
                    <div v-if="errors.length > 0" class="alert border-danger bg-transparent text-danger" role="alert">
                        <div v-for="error in errors">{{error}}</div>
                    </div>
                </form>
                <div class="list-group">
                    <a
                            :key="ticket.id"
                            @click.prevent="view(ticket.id)"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            href="#"
                            v-for="ticket in tickets">
                        <span>{{ ticket.title }}</span>
                        <user :id="ticket.created_user_id"/>
                    </a>
                </div>
                <modal :ticket-id="ticketId" id="detail"/>
            </div>
        </div>
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
                title: '',
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
                axios.get('new-tickets').then(response => {
                    this.tickets = response.data.data;
                }).finally(() => {
                    this.showTicketsLoader = false;
                });
            },
            add() {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.showButtonLoader = true;
                    this.errors = [];
                    axios.post('ticket', {title: this.title})
                        .then(response => {
                            this.tickets.unshift(response.data);
                            this.title = '';
                            this.$v.$reset();
                        })
                        .catch(e => {
                            this.errors.push(e.response.data.message);
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
            title: {
                required
            }
        },
        beforeDestroy() {
            clearInterval(this.interval);
        }
    }
</script>
