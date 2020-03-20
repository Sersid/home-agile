<template>
    <div class="d-flex">
        <avatar :key="userId" :id="userId" class="mr-1 mt-1" size="sm" v-for="userId in ticket.watchers"/>
        <b-dropdown class="fs-lg mr-2" no-caret right v-if="canAddWatchers.length > 0" variant="icon">
            <template v-slot:button-content>
                <i class="fal fa-user-plus" ref="button"></i>
            </template>
            <b-dropdown-item :key="index" @click.prevent="addWatcher(u.id)" href="#" v-for="(u, index) in canAddWatchers">
                <avatar :id="u.id" class="mr-2" size="sm"/>
                {{u.name}}
            </b-dropdown-item>
        </b-dropdown>
    </div>
</template>

<script>
    import Avatar from '../system/Avatar';
    import users from '../../mixins/users';

    export default {
        name: "Watchers",
        props: {
            ticket: {
                type: Object,
                required: true
            }
        },
        mixins: [users],
        components: {Avatar},
        computed: {
            canAddWatchers() {
                let result = [];
                for (let id in this.users) {
                    if (this.ticket.watchers.indexOf(parseInt(id)) === -1) {
                        result.push(this.users[id]);
                    }
                }
                return result;
            }
        },
        methods: {
            addWatcher(user_id) {
                this.$emit('process', true);
                axios.post('/ticket/add-watcher', {ticket_id: this.ticket.id, user_id: user_id})
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
