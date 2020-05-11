<template>
    <i class="fa fa-circle" :class="textType"></i>
</template>

<script>
    import {mapGetters} from "vuex"
    export default {
        props: {
            username: {
                type: String,
                required: true
            }
        },
        computed: {
            ...mapGetters(["usersOnline"]),
            status(){
                return this.usersOnline.find(data => data == this.username)? true : false;
            },
            textType(){
                return this.status ? "text-success" : "text-danger"
            }
        }
    }
</script>

<style scoped>

</style>
