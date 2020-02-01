<template>
    <div>
        <b-modal :id="id" dialog-class="modal-dialog-right" hide-footer size="xl" title-class="h4" @hidden="closeModal">
            <template v-slot:modal-title>
                <span v-if="showSpinner">Загрузка...</span>
                <span v-else-if="hasError">Ошибка</span>
                <span v-else><a href="#">#ticket-{{ticket.id}}</a> <span class="fw-300"><i>Просмотр тикета</i></span></span>
            </template>
            <div class="d-flex justify-content-center mb-3" v-if="showSpinner">
                <b-spinner label="Загрузка..." style="width: 8rem; height: 8rem;" type="grow" variant="warning"></b-spinner>
            </div>
            <div class="alert alert-danger" role="alert" v-else-if="hasError">
                {{error}}
            </div>
            <div v-else>
                <div class="card mb-g" v-if="!showEditForm">
                    <div class="card-body p-3">
                        <div class="fw-n float-right ml-3">
                            <b-spinner class="mt-1" label="Сохранение..." small v-if="showSaveSpinner" variant="warning"></b-spinner>
                            <button @click.prevent="showForm" class="btn btn-outline-default" type="button" v-else>
                                <span class="text-muted"><i class="fal fa-pen-alt"></i></span>
                            </button>
                        </div>
                        <h5 :class="'text-' + getStatus(ticket.status).color" class="mb-0">
                            <small class="fs-nano mt-0 mb-2 text-muted">
                                <span>Создала <a href="#">{{author}}</a> {{dateCreate}}</span><span v-if="hasUpdated">, обновил <a href="#">{{redactor}}</a> {{dateUpdate}}</span>
                            </small>
                            <watcher :ticket="ticket" class="mr-1" @process="showProcessLoader" @saved="updated" />
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
                <update-form :ticket="ticket" @cancel="hideForm" @saved="updated" v-if="showEditForm"></update-form>

                <div class="card mb-g">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="text-muted mb-2">Доска</div>
                                <agile-changer :ticket="ticket" @process="showProcessLoader" @saved="updated"/>
                            </div>
                        </div>
                    </div>
                </div>

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
    import Watcher from './Watcher';

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
            Watcher
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
            dateCreate() {
                return moment(this.ticket.created_at).calendar().toLowerCase();
            },
            redactor() {
                return this.getUser(this.ticket.updated_user_id).name;
            },
            dateUpdate() {
                return moment(this.ticket.updated_at).calendar().toLowerCase();
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
            updated(ticket) {
                this.ticket = Object.assign( {}, this.ticket, ticket);
                this.hideForm();
                this.$emit('updated', this.ticket);
            },
            showProcessLoader(process) {
                this.showSaveSpinner = process;
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
