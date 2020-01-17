<template>
    <form @submit.prevent="add">
        <div class="input-group mb-3">
            <input :class="{'is-invalid': $v.title.$error}"
                   :disabled="showButtonLoader"
                   @input="$v.title.$touch()"
                   autofocus
                   class="form-control form-control-lg"
                   placeholder="Новая задача"
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
        <div class="alert alert-danger" role="alert" v-if="$v.title.$error">
            Напиши хоть что-нибудь :(
        </div>
        <div class="alert alert-danger" role="alert" v-if="hasError">
            {{error.message}}
            <div v-for="field in error.errors">
                <div v-for="err in field">{{err}}</div>
            </div>
        </div>
    </form>
</template>

<script>
    import {required} from 'vuelidate/lib/validators';

    export default {
        name: "QuickAdd",
        data() {
            return {
                title: '',
                showButtonLoader: false,
                error: {},
            }
        },
        methods: {
            add() {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.showButtonLoader = true;
                    this.error = {};
                    axios.post('ticket', {title: this.title})
                        .then(response => {
                            this.title = '';
                            this.$v.$reset();
                            this.$emit('added', response.data);
                        })
                        .catch(e => {
                            this.error = e.response.data;
                        })
                        .finally(() => {
                            this.showButtonLoader = false;
                        });
                }
            }
        },
        computed: {
            hasError() {
                return Object.keys(this.error).length !== 0;
            }
        },
        validations: {
            title: {
                required
            }
        }
    }
</script>
