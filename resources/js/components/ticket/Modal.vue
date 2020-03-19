<template>
    <div>
        <b-modal :id="id" dialog-class="modal-dialog-right" hide-footer size="xl" title-class="h4" @hidden="closeModal">
            <template v-slot:modal-title>
                <span v-if="showSpinner">Загрузка...</span>
                <span v-else-if="hasError">Ошибка</span>
                <span v-else><span class="text-primary">#ticket-{{ticket.id}}</span> <span class="fw-300"><i>Просмотр тикета</i></span></span>
            </template>
            <div class="d-flex justify-content-center mb-3" v-if="showSpinner">
                <b-spinner label="Загрузка..." style="width: 8rem; height: 8rem;" type="grow" variant="warning"></b-spinner>
            </div>
            <div class="alert alert-danger" role="alert" v-else-if="hasError">
                {{error}}
            </div>
            <div v-else>
                <div class="card mb-g" v-if="!showEditForm">
                    <div class="card-body">
                        <div class="fw-n position-absolute pos-top pos-right ml-2">
                            <b-spinner class="m-2" label="Сохранение..." small v-if="showSaveSpinner" variant="warning"/>
                            <b-dropdown v-else variant="icon" class="fs-lg" right no-caret>
                                <template v-slot:button-content>
                                    <i class="far fa-ellipsis-v"></i>
                                </template>
                                <b-dropdown-item @click.prevent="showForm">
                                    <i class="fal fa-pen-alt mr-2"></i>
                                    Редактировать
                                </b-dropdown-item>
                                <b-dropdown-item v-if="isWatch" @click.prevent="changeWatch">
                                    <i class="fal fa-bell-slash mr-2"></i>
                                    Не наблюдать
                                </b-dropdown-item>
                                <b-dropdown-item v-else @click.prevent="changeWatch">
                                    <i class="fal fa-bell mr-2"></i>
                                    Наблюдать
                                </b-dropdown-item>
                            </b-dropdown>
                        </div>
                        <h5 :class="'text-' + getStatus(ticket.status).color" class="mb-0">
                            {{ticket.title}}
                        </h5>
                        <div class="mt-3">
                            <div v-if="hasDescription">
                                <vue-markdown>{{ticket.description}}</vue-markdown>
                            </div>
                            <a @click.prevent="showForm" class="d-block p-3 rounded border border-primary" href="#" style="border-style: dashed !important;" v-else>
                                Нажми на меня, чтоб добавить описание
                            </a>
                        </div>
                    </div>
                </div>
                <update-form :ticket="ticket" @cancel="hideForm" @saved="updated" v-if="showEditForm"/>
                <div class="card mb-g">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="text-muted mb-2">Исполнитель</div>
                                <executor-changer :ticket="ticket" @process="showProcessLoader" @saved="updated"/>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="text-muted mb-2">Приоритет</div>
                                <priority-changer :ticket="ticket" @process="showProcessLoader" @saved="updated"/>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="text-muted mb-2">Срок</div>
                                <term-changer :ticket="ticket" @process="showProcessLoader" @saved="updated"/>
                            </div>
                            <div class="col-lg-3 col-6 mb-3">
                                <div class="text-muted mb-2">Статус</div>
                                <status-changer :ticket="ticket" @process="showProcessLoader" @saved="updated"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12 mb-3">
                                <div class="text-muted mb-2">Доска</div>
                                <agile-changer :ticket="ticket" @process="showProcessLoader" @saved="updated"/>
                            </div>
                            <div class="col-lg-6 col-12 mb-3">
                                <div class="text-muted mb-2">Наблюдатели</div>
                                <watchers :ticket="ticket" @process="showProcessLoader" @saved="updated" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-g">
                    <div class="card-body text-muted">
                        <span>{{createdText}} <a href="#">{{author}}</a> {{dateCreate}}</span><span v-if="hasUpdated">,
                        {{updatedText}} <a href="#">{{redactor}}</a> {{dateUpdate}}</span>
                    </div>
                </div>
                <comments :id="ticket.id" @added="$emit('addedComment', ticket.id)"/>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import users from '../../mixins/users';
    import statuses from '../../mixins/statuses';
    import moment from 'moment';
    import UpdateForm from './UpdateForm';
    import VueMarkdown from 'vue-markdown';
    import StatusChanger from './StatusChanger';
    import PriorityChanger from './PriorityChanger';
    import ExecutorChanger from './ExecutorChanger';
    import TermChanger from './TermChanger';
    import Comments from './Comments';
    import AgileChanger from './AgileChanger';
    import Watchers from './Watchers';

    moment.locale('ru');

    export default {
        name: "Modal",
        components: {
            UpdateForm,
            VueMarkdown,
            StatusChanger,
            PriorityChanger,
            ExecutorChanger,
            TermChanger,
            Comments,
            AgileChanger,
            Watchers
        },
        mixins: [users, statuses],
        props: {
            id: {
                type: String,
                required: true
            },
            ticketId: {
                type: Number
            }
        },
        created() {
            this.fetchDetail(this.ticketId);
        },
        watch: {
            ticketId(val) {
                this.fetchDetail(val);
            }
        },
        data: function() {
            return {
                showSpinner: true,
                ticket: {},
                error: '',
                showEditForm: false,
                showSaveSpinner: false
            };
        },
        computed: {
            hasError() {
                return this.error !== '';
            },
            hasDescription() {
                return typeof this.ticket.description === 'string' && this.ticket.description.length > 0;
            },
            priority() {
                return this.$store.state.priorities[this.ticket.priority];
            },
            hasUpdated() {
                return this.ticket.updated_at !== null && this.ticket.updated_at !== this.ticket.created_at;
            },
            author() {
                return this.getUser(this.ticket.created_user_id).name;
            },
            createdText() {
                return this.isMale(this.ticket.created_user_id) ? 'Создал' : 'Создала';
            },
            updatedText() {
                return this.isMale(this.ticket.updated_user_id) ? 'обновил' : 'обновила';
            },
            dateCreate() {
                return moment(this.ticket.created_at).calendar().toLowerCase();
            },
            redactor() {
                return this.getUser(this.ticket.updated_user_id).name;
            },
            dateUpdate() {
                return moment(this.ticket.updated_at).calendar().toLowerCase();
            },
            isWatch() {
                return this.ticket.watchers.indexOf(this.$store.state.user.id) >= 0;
            }
        },
        methods: {
            fetchDetail(id) {
                if (id !== null) {
                    this.showSpinner = true;
                    axios.get('ticket/' + id)
                        .then(response => {
                            this.ticket = response.data;
                            this.title = this.ticket.title;
                            this.description = this.ticket.description;
                            this.hideForm();
                        })
                        .catch(e => {
                            this.error = e.response.data.message;
                        })
                        .finally(() => {
                            this.showProcessLoader(false);
                            this.showSpinner = false;
                        });
                }
            },
            showForm() {
                this.showEditForm = true;
            },
            hideForm() {
                this.showEditForm = false;
            },
            updateTicket(ticket) {
                this.ticket = Object.assign( {}, this.ticket, ticket);
            },
            updated(ticket) {
                this.updateTicket(ticket);
                this.hideForm();
                this.$emit('updated', this.ticket);
            },
            showProcessLoader(process) {
                this.showSaveSpinner = process;
            },
            changeWatch() {
                this.showProcessLoader(true);
                axios.post('/ticket/' + (this.isWatch ? 'unwatch' : 'watch'), {ticket_id: this.ticket.id})
                    .then(response => {
                        this.updateTicket(response.data);
                    })
                    .finally(() => {
                        this.showProcessLoader(false);
                    });
            },
            closeModal() {
                this.$router.push({
                    name: this.ticket.agile_id !== null ? 'agile' : 'agile-default',
                    params: { agileId: this.ticket.agile_id }
                }).catch(err => {});
            }
        }
    }
</script>

<style scoped>

</style>
