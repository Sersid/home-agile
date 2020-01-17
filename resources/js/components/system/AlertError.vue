<template>
    <div class="alert alert-danger" role="alert" v-if="hasError">
        {{error.message}}
        <div v-for="field in error.errors">
            <div v-for="err in field">{{err}}</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AlertError",
        props: {
            error: {
                type: Object,
                required: true
            }
        },
        computed: {
            hasError() {
                return Object.keys(this.error).length !== 0;
            }
        },
    }
</script>

<style scoped>

</style>
