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
                <div class="card mb-g">
                    <div class="card-body p-3">
                        <div>
                            <div>
                                <h5 class="text-info">
                                    {{ticket.title}}
                                    <small class="fs-nano mt-0 mb-2 text-muted">
                                        Создала <a href="#">Маша</a> 31 января 2019 в 20:38,
                                        обновил <a href="#">Сережа</a> 12 января в 16:15
                                    </small>
                                </h5>
                                <span class="badge badge-info fw-n position-absolute pos-top pos-right mt-3 mr-3">New</span>
                            </div>
                            <div>{{ticket.description}}</div>
                            <!--                        <div class="mt-2 text-danger"><span><i class="fal fa-stopwatch"></i></span> <span>01 января 2020</span></div>-->
                            <!--                        <div class="mt-2"><a href="#" class="profile-image-md rounded-circle d-inline-block" style="background-image: url(img/demo/avatars/avatar-g.png); background-size: cover;"></a></div>-->
                        </div>
                    </div>
                </div>
                <div class="card mb-g">
                    <div class="px-3 pt-3 pb-2">
                        <h5>Комментарии</h5>
                    </div>
                    <div class="border-faded border-left-0 border-right-0 bg-faded p-3">
                        <textarea class="form-control rounded-top border-bottom-left-radius-0 border-bottom-right-radius-0 border" placeholder="Добавить комментарий" rows="2"></textarea>
                        <div class="d-flex justify-content-end py-2 px-2 bg-white border border-top-0 rounded-bottom">
                            <button class="btn btn-icon fs-lg mr-2" type="button">
                                <i class="fal fa-paperclip"></i></button>
                            <button class="btn btn-primary btn-sm ml-auto ml-sm-0">Отправить
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-row pt-3 pb-2">
                                <span><a class="profile-image rounded-circle d-inline-block" href="#" style="background-image: url(&quot;img/demo/avatars/avatar-j.png&quot;);"></a></span>
                                <div class="ml-3">
                                    <div><a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                        Hatchensen</a>
                                        <span class="fs-nano text-muted mt-1">5 mins ago</span></div>
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
                                    <div><a class="fw-700 text-dark" href="#" title="Lisa Hatchensen">Lisa
                                        Hatchensen</a>
                                        <span class="fs-nano text-muted mt-1">5 mins ago</span></div>
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
                error: ''
            };
        },
        computed: {
            hasError() {
                return this.error !== '';
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
