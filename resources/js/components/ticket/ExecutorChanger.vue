<template>
    <div class="d-flex">
        <b-dropdown variant="icon" class="fs-lg mr-2" no-caret>
            <template v-slot:button-content>
                <i v-if="hasExecutor" class="fal fa-exchange"></i>
                <i v-else class="fal fa-user-plus" ref="button"></i>
            </template>
            <b-dropdown-item :key="index" @click.prevent="save(index)" href="#" v-for="(u, index) in users">
                <span v-if="parseInt(index) === data.executor_id">&blacktriangleright;</span>
                <avatar :id="u.id" size="sm" class="mr-2" />{{u.name}}
            </b-dropdown-item>
        </b-dropdown>
        <span v-if="hasExecutor" class="d-flex">
            <span class="d-inline-block"><avatar :id="data.executor_id" size="md" /></span>
            <span class="align-self-center p-2">{{getUser(data.executor_id).name}}</span>
        </span>
        <div v-else class="text-muted pt-2 cursor-pointer" @click="$refs.button.click()">не указан</div>
    </div>
</template>

<script>
    import users from '../../mixins/users';
    import Avatar from '../system/Avatar';
    export default {
        name: "ExecutorChanger",
        mixins: [users],
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        components: {Avatar},
        data() {
            return {
                data: Object
            };
        },
        created() {
            this.data = this.ticket;
        },
        computed: {
            hasExecutor() {
                return this.data.executor_id !== null;
            }
        },
        methods: {
            save(executor) {
                this.$set(this.data, 'executor_id', parseInt(executor));
                this.$emit('process', true);
                axios.patch('ticket/executor/' + this.data.id, {executor_id: this.data.executor_id})
                    .then(response => {
                        this.$emit('saved', response.data);
                    })
                    .finally(() => {
                        this.$emit('process', false);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
