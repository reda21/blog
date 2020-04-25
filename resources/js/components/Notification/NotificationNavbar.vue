<template>
    <li class="nav-item dropdown nav-icon">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" href="#"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell"></i>
            <span class="nav-notif">{{total}}</span>
        </a>
        <ul class="notification dropdown-menu dropdown-menu-right" aria-label="navbarDropdownMenuLink">
            <li class="dropdown-item dropdown-header">
                {{total|notifNumbre}}
            </li>
            <li class="dropdown-item dropdown-body">
                <ul>
                    <notification-navbar-unit :key="notification.id" :notification="notification"
                                              v-for="notification in notifications"/>
                </ul>
            </li>
            <li class="dropdown-item dropdown-footer">
                <a :href="urlNotif">Voir tout</a>
            </li>

        </ul>
    </li>
</template>

<script>
    import NotificationNavbarUnit from "./NotificationNavbarUnit"
    import data from "../user/not.json"
    import {mapGetters, mapActions} from "vuex"

    export default {
        data() {
            return {
                urlNotif
            }
        },
        components: {
            NotificationNavbarUnit
        },
        computed: {
            ...mapGetters({notifications: "notifications", total: "notificationsCount"})
        },
        methods: {
            ...mapActions(["addNotifs"])
        },
        mounted() {
            this.addNotifs();
        }

    }
</script>

<style>
    p.notification-msg strong {
        color: #c00;
    }

    .dropdown-item.dropdown-footer a {
        display: block;
        text-decoration: none;
        color: #333;
    }
</style>
