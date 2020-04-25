<template>
    <li :class="{unread: !notification.read}">
        <a :href="url">
            <div class="media">
                <img class="rounded-circle" :src="notification.logo" alt="Generic placeholder image">
                <div class="media-body">
                    <p class="notification-msg" v-html="notification.label"></p>
                    <span class="notification-time pull-right">{{notification.create_at | date}}</span>
                </div>
            </div>
        </a>
    </li>
</template>

<script>
    export default {
        props: {
            notification: Object
        },
        computed: {
            url() {
                return urlNotif + "/" + this.notification.id;
            },

        }
    }
</script>

<style scoped>
    a{
        text-decoration: none;
        color:  #6c757d;
    }
</style>
