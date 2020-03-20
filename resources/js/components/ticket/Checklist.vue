<template>
    <div class="card mb-g">
        <div class="card-body">
            <h5 class="text-muted">
                <span class="fal fa-tasks mr-2"></span>
                Чек-лист
            </h5>
            <hr>
            <div class="mb-3">
                <div class="d-flex" v-for="(item, index) in checklist">
                    <div class="w-100 custom-control custom-checkbox pt-1">
                        <input
                                :checked="item.status === 200"
                                :id="'checklist-' + item.id"
                                @change="change(index)"
                                class="custom-control-input"
                                type="checkbox"
                                v-model="values[index]"
                                value="200"
                        >
                        <label :for="'checklist-' + item.id" class="custom-control-label">{{item.title}}</label>
                    </div>
                    <b-dropdown no-caret right variant="icon">
                        <template v-slot:button-content>
                            <i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
                        </template>
                        <b-dropdown-item @click.prevent="remove(index)">
                            <i class="fal fa-trash-alt mr-2"></i>
                            Удалить
                        </b-dropdown-item>
                    </b-dropdown>
                </div>
            </div>
            <form @submit.prevent="add">
                <div class="input-group mb-3">
                    <input :class="{'is-invalid': $v.title.$error}"
                           :disabled="showButtonLoader"
                           @input="$v.title.$touch()"
                           class="form-control"
                           placeholder="Добавить элемент..."
                           type="text"
                           v-model="title"
                    >
                    <div class="input-group-append">
                        <button :disabled="showButtonLoader" class="btn btn-primary" type="submit">
                            <b-spinner label="Загрузка..." small v-if="showButtonLoader"></b-spinner>
                            <span class="far fa-plus" v-else></span>
                        </button>
                    </div>
                </div>
                <div class="alert alert-danger" role="alert" v-if="$v.title.$error">
                    Напиши хоть что-нибудь :(
                </div>
                <alert-error :error="error"/>
            </form>
        </div>
    </div>
</template>

<script>
    import {required} from 'vuelidate/lib/validators';
    import AlertError from '../system/AlertError';

    export default {
        name: "Checklist",
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        components: {AlertError},
        data() {
            return {
                title: '',
                showButtonLoader: false,
                error: {},
                checklist: [],
                values: {}
            }
        },
        methods: {
            add() {
                this.$v.$touch();
                if (!this.$v.$invalid) {
                    this.showButtonLoader = true;
                    this.error = {};
                    axios.post('ticket/checklist', {title: this.title, ticket_id: this.ticket.id})
                        .then(response => {
                            this.title = '';
                            this.$v.$reset();
                            this.checklist.push(response.data);
                        })
                        .catch(e => {
                            this.error = e.response.data;
                        })
                        .finally(() => {
                            this.showButtonLoader = false;
                        });
                }
            },
            change(index) {
                axios.patch('ticket/checklist/' + this.checklist[index].id, {
                        title: this.checklist[index].title,
                        status: this.values[index]
                    })
                    .catch(e => {
                        this.error = e.response.data;
                    });
            },
            remove(index) {
                axios.delete('ticket/checklist/' + this.checklist[index].id)
                    .catch(e => {
                        this.error = e.response.data;
                    })
                    .finally(() => {
                        this.checklist.splice(index, 1);
                    });
            }
        },
        validations: {
            title: {
                required
            }
        },
        created() {
            this.checklist = this.ticket.checklist;
            for (let index in this.checklist) {
                this.values[index] = this.checklist[index].status === 200;
            }
        }
    }

</script>

<style scoped>
    .custom-control {
        padding-left: 2rem;
        min-height: 1.59437rem;
    }

    .custom-control-label {
        padding-top: 0.2rem;
    }

    input[type="checkbox"]:checked + .custom-control-label {
        text-decoration: line-through;
    }

    .custom-control-label::before, .custom-control-label::after {
        width: 1.525rem;
        height: 1.525rem;
        left: -2rem;
    }
</style>
