<template>
    <div class="card mb-g">
        <div class="px-3 pt-3 pb-2">
            <h5>Комментарии</h5>
            <div class="fw-n position-absolute pos-top pos-right mt-3 mr-3" v-if="showCommentsLoader">
                <b-spinner class="mt-1" label="Загрузка..." small variant="warning"></b-spinner>
            </div>
        </div>
        <div class="border-faded border-left-0 border-right-0 bg-faded p-3">
            <textarea
                    :class="{'is-invalid': $v.text.$error}"
                    :disabled="showButtonLoader"
                    @input="$v.text.$touch()"
                    @keydown.enter.ctrl="add"
                    class="form-control rounded-top border-bottom-left-radius-0 border-bottom-right-radius-0 border"
                    placeholder="Добавить комментарий"
                    rows="3"
                    v-model="text"/>
            <div class="d-flex justify-content-end py-2 px-2 bg-white border border-top-0 rounded-bottom">
                <!--                <button class="btn btn-icon fs-lg mr-2" type="button">-->
                <!--                    <i class="fal fa-paperclip"></i>-->
                <!--                </button>-->
                <button :disabled="showButtonLoader" @click="add" class="btn btn-primary ml-auto ml-sm-0">
                    <b-spinner label="Загрузка..." small v-if="showButtonLoader"></b-spinner>
                    Отправить
                </button>
            </div>
            <alert-error :error="error"/>
        </div>
        <div class="card-body" v-if="comments.length > 0">
            <div class="d-flex flex-column">
                <div :key="comment.id" class="d-flex flex-row pt-3 pb-2" v-for="comment in comments">
                    <span><a class="d-inline-block" href="#"><avatar :id="comment.created_user_id" /></a></span>
                    <div class="ml-3">
                        <div class="mb-1">
                            <a class="fw-700 text-dark" href="#">{{getUser(comment.created_user_id).name}}</a>
                            <span class="fs-nano text-muted mt-1">{{dateCreate(comment.created_at)}}</span>
                        </div>
                        {{comment.text}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {required} from 'vuelidate/lib/validators'
    import users from '../../mixins/users';
    import AlertError from '../system/AlertError';
    import moment from 'moment';
    import Avatar from '../system/Avatar';

    export default {
        name: "Comments",
        props: {
            id: {
                type: Number,
                required: true
            }
        },
        mixins: [users],
        components: {Avatar, AlertError},
        data() {
            return {
                comments: [],
                text: '',
                showButtonLoader: false,
                showCommentsLoader: true,
                error: {}
            }
        },
        validations: {
            text: {
                required
            }
        },
        methods: {
            fetch() {
                axios.get('/ticket/comments/' + this.id)
                    .then(response => {
                        this.comments = response.data;
                    })
                    .finally(() => {
                        this.showCommentsLoader = false;
                    });
            },
            add() {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.showButtonLoader = true;
                    this.error = {};
                    axios.post('/ticket/comments', {ticket_id: this.id, text: this.text})
                        .then(response => {
                            this.comments.unshift(response.data);
                            this.text = '';
                            this.$v.$reset();
                            this.$emit('added');
                        })
                        .catch(e => {
                            this.error = e.response.data;
                        })
                        .finally(() => {
                            this.showButtonLoader = false;
                        });
                }
            },
            dateCreate(date) {
                return moment(date).fromNow()
            },
        },
        created() {
            this.fetch();
        }
    }
</script>

<style scoped>

</style>
