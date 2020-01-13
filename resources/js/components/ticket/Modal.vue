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
                <div v-if="!showForm" class="card mb-g">
                    <div class="card-body p-3">
                        <h5 class="mb-0" :class="'text-' + status.color">
                            <small class="fs-nano mt-0 mb-2 text-muted">
                                Создала <a href="#">Маша</a> 31 января 2019 в 20:38,
                                обновил <a href="#">Сережа</a> 12 января в 16:15
                            </small>
                            {{ticket.title}}
                        </h5>
                        <div class="fw-n position-absolute pos-top pos-right mt-3 mr-3">
                            <button class="btn btn-outline-default" type="button">
                                <span class="text-muted"><i class="fal fa-pen-alt"></i></span>
                            </button>
                        </div>
                        <div v-if="hasDescription" class="mt-3">{{ticket.description}}</div>
                    </div>
                </div>
                <div v-if="showForm" class="card mb-g">
                    <div class="p-3 border-faded border-left-0 border-right-0  border-top-0">
                        <div class="form-group">
                            <input class="form-control" placeholder="Заголовок" type="text">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Описание" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="text-right p-3 pt-0">
                        <a href="#">Отменить</a>
                        <button class="btn btn-primary ml-3" type="submit">Сохранить изменения</button>
                    </div>
                </div>

                <div class="card mb-g">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="text-muted mb-2">Исполнитель</div>
                                <div class="d-flex">
                                    <button class="btn btn-icon fs-lg mr-1" type="button">
                                        <i class="fal fa-exchange"></i></button>
                                    <a class="d-flex" href="#">
                                        <span class="profile-image-md rounded-circle d-inline-block" style="background-image: url(&quot;img/demo/avatars/avatar-g.png&quot;); background-size: cover;"></span>
                                        <span class="align-self-center p-2">Сережа</span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-muted mb-2">Приоритет</div>
                                <button :class="'btn-outline-' + priority.color" class="btn dropdown-toggle" type="button">
                                    {{priority.name}}
                                </button>
                            </div>
                            <div class="col-3">
                                <div class="text-muted mb-2">Срок</div>
                                <button class="btn btn-icon fs-lg mr-1" type="button">
                                    <i class="fal fa-calendar-alt"></i>
                                </button>
                                9 декабря 2019
                            </div>
                            <div class="col-3">
                                <div class="text-muted mb-2">Статус</div>
                                <button :class="'btn-outline-' + status.color" class="btn dropdown-toggle" type="button">
                                    {{status.name}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-g">
                    <div class="px-3 pt-3 pb-2"><h5>Комментарии</h5></div>
                    <div class="border-faded border-left-0 border-right-0 bg-faded p-3">
                        <textarea class="form-control rounded-top border-bottom-left-radius-0 border-bottom-right-radius-0 border" placeholder="Добавить комментарий" rows="2"></textarea>
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
                        </div>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import User from '../User';
    import Comments from './Comments';

    export default {
        name: "Modal",
        components: {User, Comments},
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
                showForm: false
            };
        },
        computed: {
            hasError() {
                return this.error !== '';
            },
            hasDescription() {
              return typeof this.ticket.description === 'string' && this.ticket.description.length > 0;
            },
            status() {
                return this.$store.state.statuses[this.ticket.status];
            },
            priority() {
                return this.$store.state.priorities[this.ticket.priority];
            }
        },
        methods: {
            fetchDetail(id) {
                this.showSpinner = true;
                axios.get('ticket/' + id)
                    .then(response => {
                        this.ticket = response.data;
                    })
                    .catch(e => {
                        this.error = e.response.data.message;
                    })
                    .finally(() => {
                        this.showSpinner = false;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
