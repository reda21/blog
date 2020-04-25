<template>
    <div class="notification">
        <spinner-loader v-if="loading"></spinner-loader>
        <ul v-else class="notification-body">
            <notification-item :key="notification.id" :notification="notification"
                               v-for="notification in notifications"/>

        </ul>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from "vuex"
    import NotificationItem from "./NotificationItem"

    export default {
        components: {
            NotificationItem
        },
        data() {
            return {}
        },
        computed: {
            ...mapGetters({
                notifications: "notifications",
                total: "notificationsCount",
                loading: "loadingNotifications"
            })
        },
        methods: {
            ...mapActions([""])
        },
       mounted() {

       }
    }
</script>

<style scoped>

</style>
