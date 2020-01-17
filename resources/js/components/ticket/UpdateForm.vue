<template>
    <div class="card mb-g">
        <form @submit.prevent="save">
            <div class="p-3 border-faded border-left-0 border-right-0  border-top-0">
                <alert-error :error="error" />
                <div class="form-group">
                    <input :class="{'is-invalid':  $v.title.$error}"
                           :disabled="showButtonLoader"
                           @input="$v.title.$touch()"
                           @keydown.enter="save"
                           class="form-control"
                           placeholder="Заголовок"
                           type="text"
                           v-model="title"
                    >
                </div>
                <div class="alert alert-danger" role="alert" v-if="$v.title.$error">
                    Напиши хоть что-нибудь :(
                </div>
                <div class="form-group">
                    <textarea :disabled="showButtonLoader" :rows="rows" @keydown.enter.ctrl="save" class="form-control" placeholder="Описание" v-model="description"/>
                </div>
            </div>
            <div class="text-right p-3 pt-0">
                <button @click.prevent="cancel" class="btn btn-link" v-show="!showButtonLoader">Отменить</button>
                <button :disabled="showButtonLoader" class="btn btn-primary" type="submit">
                    <b-spinner label="Загрузка..." small v-if="showButtonLoader"></b-spinner>
                    Сохранить изменения
                </button>
            </div>
        </form>
        <div class="p-3 border-faded border-left-0 border-right-0 border-bottom-0" v-if="hasDescription">
            <vue-markdown :source="description"/>
        </div>
    </div>
</template>

<script>
    import {required} from 'vuelidate/lib/validators'
    import VueMarkdown from 'vue-markdown';
    import AlertError from '../system/AlertError';

    export default {
        name: "UpdateForm",
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        components: {VueMarkdown, AlertError},
        created() {
            this.id = this.ticket.id;
            this.title = this.ticket.title;
            this.description = this.ticket.description;
        },
        computed: {
            hasDescription() {
                return this.description !== null && this.description.length > 0;
            },
            rows() {
                let lines = this.description === null ? 0 : this.description.split("\n").length;
                return lines > 3 ? lines : 3;
            }
        },
        data() {
            return {
                id: Number,
                title: String,
                description: String,
                showButtonLoader: false,
                error: Object,
            };
        },
        validations: {
            title: {
                required
            }
        },
        methods: {
            cancel() {
                this.$emit('cancel');
            },
            save() {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.showButtonLoader = true;
                    this.error = {};
                    axios.patch('ticket/' + this.id, {title: this.title, description: this.description})
                        .then(response => {
                            this.$v.$reset();
                            this.$emit('saved', response.data);
                        })
                        .catch(e => {
                            this.error = e.response.data;
                        })
                        .finally(() => {
                            this.showButtonLoader = false;
                        });
                }
            }
        }
    }
</script>

<style scoped>

</style>
