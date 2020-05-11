<template>
    <div class="chat mt-3">
        <div class="card chat-menu">
            <div class="card-header chat-search d-none d-md-block d-lg-block d-xl-block">
                <div class="input-group">
                    <input type="text" placeholder="Search..." name="" class="form-control search">
                    <div class="input-group-prepend">
                        <span class="input-group-text search_btn"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
            <chat-contact></chat-contact>
            <div class="card-footer">
                <div id="bottom-bar">
                    <button id="addcontact">
                        <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span>
                    </button>
                    <button id="settings">
                        <i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span>
                    </button>
                </div>
            </div>
        </div>
        <router-view :key="$route.fullPath" class="view"></router-view>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import chatContact from "./chatContact"

    export default {
        components: {
            chatContact,
        },
        name: "chatList",
        data() {
            return {}
        },
        computed: {
            ...mapGetters(['conversations',"loadingConversations"])
        },
    }
</script>

<style scoped>

</style>
