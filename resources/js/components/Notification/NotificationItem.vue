<template>
    <li class="notification">
        <a :href="url">
            <div class="media">
                <div class="media-left">
                    <div class="media-object">
                        <img class="img-circle" :src="notification.logo">
                    </div>
                </div>
                <div class="media-body">
                    <a href="#" class="notification-reset" @click.stop.prevent="destroy">
                        <i aria-hidden="true" class="fa fa-times"></i>
                    </a> <!---->
                    <p class="notification-desc" v-html="notification.label"/>
                    <div class="notification-meta pull-right mr-5">
                        <small>
                            <i class="fa fa-clock-o mr-1"></i> {{notification.create_at | date}}
                        </small>
                    </div>
                </div>
            </div>
        </a>
    </li>
</template>

<script>
    export default {
        props: {
            notification: Object,
        },
        data() {
            return {
                notificationRessource: this.$resource("notifications{/id}"),
            }
        },
        computed: {
            url() {
                return urlNotif + "/" + this.notification.id;
            },

        },
        methods: {
            destroy() {
                this.notificationRessource.delete({id: this.notification.id});
            }
        }
    }
</script>

<style scoped>
    a{
        cursor: pointer;
        text-decoration: none;
        color:  #6c757d;
    }
</style>
