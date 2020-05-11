<template>
    <div class="card-body msg_card_body">
        <message-loading v-if="loading"></message-loading>
        <message-loading :rect-width="60" v-if="loading"></message-loading>
        <message-loading :rect-width="120" v-if="loading"></message-loading>
        <component v-if="!loading" v-bind:is="composant(message)" :key="message.id" v-for="message in messages"
                   :message="message"></component>


    </div>
</template>

<script>
    import messageSender from "./messageSender";
    import messageReceiver from "./messageReceiver";
    import messageLoading from "./messageLoading"
    import {mapGetters, mapActions} from "vuex";

    export default {
        props: {
            loading: {
                type: Boolean
            },
        },
        components: {messageSender, messageReceiver, messageLoading},
        computed: {
            ...mapGetters(['messages', "myProfile"]),
        },
        methods: {
            composant(message) {
                if (this.myProfile.id == message.sender.id)
                    return "messageSender";
                return "messageReceiver";
            }
        }
    }
</script>

<style scoped>

</style>
