<template>
    <li class="nav-item dropdown nav-icon">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" href="#"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-envelope"></i>
            <span class="nav-notif">25</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-label="navbarDropdownMenuLink">
            <a href="#" class="dropdown-item">alpha</a>
            <a href="#" class="dropdown-item">beta</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">omega</a>
        </div>
    </li>
</template>

<script>
    import {mapGetters, mapActions} from "vuex"
    export default {
        data() {
            return {

            }
        },
        computed: {
            ...mapGetters(["conversations"])
        },
        methods: {
            ...mapActions(["addConversations"])
        },
        mounted() {
            this.addConversations()
        }
    }
</script>

<style scoped>

</style>
