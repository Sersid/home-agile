<template>
    <span>
        <button v-if="user === null" class="user btn btn-secondary font-weight-bold btn-sm">+</button>
        <a v-else href="#" :title="user.username" class="rounded-circle profile-image-md d-block" style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></a>
    </span>
</template>

<script>
    export default {
        name: "User",
        props: {
            id: Number
        },
        computed: {
            user() {
                var user = null;
                if (typeof this.id === 'number') {
                    this.$store.state.users.forEach(u => {
                        if (this.id === u.id) {
                            user = u;
                            return;
                        }
                    })
                }
                return user;
            }
        }
    }
</script>
