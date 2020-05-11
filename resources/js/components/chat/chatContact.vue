<template>
    <div class="card-body chat-list">
        <ul class="contacts">
            <chat-contact-load v-if="loadingConversations"></chat-contact-load>
            <chat-contact-load v-if="loadingConversations"></chat-contact-load>
            <chat-contact-load v-if="loadingConversations"></chat-contact-load>
            <chat-contact-item v-if="!loadingConversations" :key="conversation.id" v-for="conversation in conversations"
                               :conversation="conversation"/>
        </ul>
    </div>
</template>

<script>
    import contacts from "./contact.json"
    import {mapActions, mapGetters} from "vuex";
    import chatContactLoad from "./chatContactLoad";

    import chatContactItem from "./chatContactItem"

    export default {
        data() {
            return {
                contacts,
            }
        },
        components: {
            chatContactItem, chatContactLoad
        },
        computed: {
            ...mapGetters(["conversations", "loadingConversations"])
        },
    }
</script>

<style scoped>

</style>
