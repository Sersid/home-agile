<template>
    <div>
        <b-modal :id="id" dialog-class="modal-dialog-right" hide-footer size="xl" title-class="h4">
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
                        <h5 :class="'text-' + getStatus(ticket.status).color" class="mb-0">
                            <small class="fs-nano mt-0 mb-2 text-muted">
                                <span>Создала <a href="#">{{author}}</a> {{dateCreate}}</span><span v-if="hasUpdated">, обновил <a href="#">{{redactor}}</a> {{dateUpdate}}</span>
                            </small>
                            {{ticket.title}}
                        </h5>
                        <div class="fw-n position-absolute pos-top pos-right mt-3 mr-3">
                            <b-spinner v-if="showSaveSpinner" label="Сохранение..." small variant="warning" class="mt-1"></b-spinner>
                            <button v-else @click.prevent="showForm" class="btn btn-outline-default" type="button">
                                <span class="text-muted"><i class="fal fa-pen-alt"></i></span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <div v-if="hasDescription"><vue-markdown>{{ticket.description}}</vue-markdown></div>
                            <a @click.prevent="showForm" class="d-block p-3 rounded border border-primary" href="#" style="border-style: dashed !important;" v-else>
                                Нажми на меня, чтоб добавить описание
                            </a>
                        </div>
                    </div>
                </div>
                <update-form v-if="showEditForm" :ticket="ticket" @cancel="hideForm" @saved="updated"></update-form>

                <div class="card mb-g">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="text-muted mb-2">Исполнитель</div>
                                <executor-changer :ticket="ticket" @process="showProcessLoader"/>
                            </div>
                            <div class="col-3">
                                <div class="text-muted mb-2">Приоритет</div>
                                <priority-changer :ticket="ticket" @process="showProcessLoader" />
                            </div>
                            <div class="col-3">
                                <div class="text-muted mb-2">Срок</div>
                                <term-changer :ticket="ticket" @process="showProcessLoader" />
                            </div>
                            <div class="col-3">
                                <div class="text-muted mb-2">Статус</div>
                                <status-changer :ticket="ticket" @process="showProcessLoader" @saved="updated" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-g">
                    <div class="px-3 pt-3 pb-2"><h5>Комментарии</h5></div>
                    <div class="border-faded border-left-0 border-right-0 bg-faded p-3">
                        <textarea class="form-control rounded-top border-bottom-left-radius-0 border-bottom-right-radius-0 border" placeholder="Добавить комментарий" rows="3"></textarea>
                        <div class="d-flex justify-content-end py-2 px-2 bg-white border border-top-0 rounded-bottom">
                            <button class="btn btn-icon fs-lg mr-2" type="button">
                                <i class="fal fa-paperclip"></i></button>
                            <button class="btn btn-primary btn-sm ml-auto ml-sm-0">
                                Отправить
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row pt-3 pb-2">
                                <span><a class="profile-image rounded-circle d-inline-block" href="#" style="background-image: url(&quot;img/demo/avatars/avatar-j.png&quot;);"></a></span>
                                <div class="ml-3">
                                    <div>
                                        <a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                            Hatchensen</a>
                                        <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                    </div>
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                </div>
                            </div>
                            <div class="d-flex flex-row pt-3 pb-2">
                                <span><a class="profile-image rounded-circle d-inline-block" href="#" style="background-image: url(&quot;img/demo/avatars/avatar-j.png&quot;);"></a></span>
                                <div class="ml-3">
                                    <div>
                                        <a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                            Hatchensen</a>
                                        <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                    </div>
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                </div>
                            </div>
                            <div class="d-flex flex-row pt-3 pb-2">
                                <span><a class="profile-image rounded-circle d-inline-block" href="#" style="background-image: url(&quot;img/demo/avatars/avatar-j.png&quot;);"></a></span>
                                <div class="ml-3">
                                    <div>
                                        <a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                            Hatchensen</a>
                                        <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                    </div>
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                </div>
                            </div>
                            <div class="d-flex flex-row pt-3 pb-2">
                                <span><a class="profile-image rounded-circle d-inline-block" href="#" style="background-image: url(&quot;img/demo/avatars/avatar-j.png&quot;);"></a></span>
                                <div class="ml-3">
                                    <div>
                                        <a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                            Hatchensen</a>
                                        <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                    </div>
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                    Hey did you meet the new board of director? He's a bit of a geek
                                    if you ask me...anyway here is the report you requested. I am
                                    off to launch with Lisa and Andrew, you wanna join?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    moment.locale('ru');

    export default {
        name: "Modal",
        components: {UpdateForm, VueMarkdown, StatusChanger, PriorityChanger, ExecutorChanger, TermChanger, Comments},
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
            },
            showForm() {
                this.showEditForm = true;
            },
            hideForm() {
                this.showEditForm = false;
            },
            updated(ticket) {
                this.ticket = ticket;
                this.hideForm();
                this.$emit('updated', this.ticket);
            },
            showProcessLoader(process) {
                this.showSaveSpinner = process;
            }
        }
    }
</script>

<style scoped>

</style>
