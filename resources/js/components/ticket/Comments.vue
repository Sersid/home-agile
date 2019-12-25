<template>
    <div>
        <h4 class="mb-3">Комментарии</h4>
        <form @submit.prevent="add">
            <div class="mb-3">
                <textarea
                    :class="{'is-invalid':  $v.text.$error || errors.length > 0}"
                    :disabled="showButtonLoader"
                    @blur="$v.text.$touch()"
                    class="form-control"
                    placeholder="Добавь свой комментарий"
                    rows="3"
                    v-model="text"
                ></textarea>
                <div class="invalid-feedback" v-if="!$v.text.required">
                    Напиши хоть что-нибудь :(
                </div>
                <div class="invalid-feedback" v-if="errors.length > 0">
                    <div v-for="error in errors">{{error.message}}</div>
                </div>
            </div>
            <button :disabled="showButtonLoader" class="btn btn-primary" type="submit">
                <b-spinner label="Загрузка..." small v-if="showButtonLoader"></b-spinner>
                Добавить
            </button>
        </form>
        <hr>
        <div class="text-center" v-if="showCommentsLoader">
            <b-spinner label="Загрузка..."></b-spinner>
        </div>
        <ul class="list-unstyled" v-if="comments.length > 0">
            <li class="media mb-4" v-for="comment in comments">
                <img alt="..." class="mr-3 rounded " src="https://sun9-2.userapi.com/c858428/v858428439/b1c99/u-zy4fEw_ws.jpg?ava=1" style="width:50px;">
                <div class="media-body">
                    <div><a href="#">Сережа</a> написал вчера в 20:39</div>
                    {{comment.text}}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import {required} from 'vuelidate/lib/validators'

    export default {
        name: "Comments",
        props: {
            ticketId: {
                type: Number,
                required: true
            }
        },
        data: function() {
            return {
                comments: [],
                text: '',
                showButtonLoader: false,
                showCommentsLoader: true,
                errors: []
            }
        },
        validations: {
            text: {
                required
            }
        },
        methods: {
            fetch() {
                this.$http.get('comments', {
                        params: {
                            'sort': '-id',
                            'filter[ticket_id]': this.ticketId
                        }
                    })
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
                    this.errors = [];
                    this.$http.post('comments', {ticket_id: this.ticketId, text: this.text})
                        .then(response => {
                            this.comments.unshift(response.data);
                            this.text = '';
                            this.$v.$reset();
                        })
                        .catch(e => {
                            this.errors = e.response.data;
                        })
                        .finally(() => {
                            this.showButtonLoader = false;
                        });
                }
            }
        },
        created() {
            this.fetch();
        }
    }
</script>

<style scoped>

</style>
