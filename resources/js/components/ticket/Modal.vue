<template>
    <div>
        <b-modal :id="id" dialog-class="modal-dialog-right" title-class="h4" hide-footer size="xl" :title="showSpinner ? 'Загрузка...' : '#ticket-' + ticket.id">
            <div v-if="showSpinner" class="d-flex justify-content-center mb-3">
                <b-spinner label="Загрузка..." variant="warning" type="grow" style="width: 8rem; height: 8rem;"></b-spinner>
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-9">
<!--                        <div>-->
<!--                            <b-badge pill variant="primary">Разработка</b-badge>-->
<!--                        </div>-->
                        <h3 class="mb-2">{{ticket.name}}</h3>
                        <hr>
                        <div class="mb-4">
                            {{ticket.description}}
                        </div>
                        <hr>
                    </div>
                    <div class="col-3">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Срок
                                <span>{{ticket.term}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Исполнитель
                                <User :id="ticket.executor_id"/>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Приоритет
                                <span>{{ticket.priority}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Статус
                                <span>{{ticket.status}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Создал
                                <span>Сережа {{ticket.created_at}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Обновила
                                <span>Маша {{ticket.updated_at}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <comments :ticket-id="ticket.id" />
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
                ticket: {}
            };
        },
        methods: {
            fetchDetail(id) {
                this.showSpinner = true;
                this.$http.get('tickets/' + id)
                    .then(response => {
                        this.showSpinner = false;
                        this.ticket = response.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
