<template>
    <div class="card chat-body">
        <chat-title-load v-if="loading"></chat-title-load>
        <chat-title :conversation="conversation" v-if="!loading"></chat-title>
        <chat-body :loading="loadingMessage"></chat-body>
        <div class="card-footer">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text attach_btn"><i class="fa fa-paperclip"></i></span>
                </div>
                <textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
                <div class="input-group-append">
                    <span class="input-group-text send_btn"><i class="fa fa-location-arrow"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from "vuex";
    import {find} from "lodash";

    import chatTitle from "./chatTitle";
    import chatTitleLoad from "./chatTitleLoad";
    import chatBody from "./chatBody";
    import chatBodyLoad from "./chatBodyLoad";

    export default {
        components: {chatTitle, chatTitleLoad, chatBody, chatBodyLoad},
        data() {
            return {
                slug: this.$route.params.slug,
                loadingMessage: true
            }
        },
        watch: {
            loading: function (newValue, oldValue) {
                if (!newValue) {
                    if (!this.conversation)
                        this.$router.push({name: 'chat'})
                    else {
                        this.loadConversation({
                            slug: this.conversation.id,
                            callback: () => this.loadingMessage = false
                        });

                    }

                }

            }
        },
        computed: {
            conversation() {
                return find(this.conversations, item => item.participant.username == this.slug)
            },
            ...mapGetters({conversations: "conversations", loading: "loadingConversations", messages: "messages"})
        },
        methods: {
            name() {

            },
            ...mapActions(["loadConversation"])
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
