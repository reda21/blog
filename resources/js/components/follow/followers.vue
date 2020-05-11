<template>
    <div class="friends">
        <follow-loader v-if="loading"></follow-loader>
        <follow-loader v-if="loading"></follow-loader>
        <follow-loader v-if="loading"></follow-loader>
        <div class="request">
            <follower-request v-if="!loading && requestsOrdre.length"></follower-request>
        </div>
        <div class="col-12">
            <pagination v-if="!loading && requestsOrdre.length && requestsOrdre.length > followersPagination.per_page"
                        :list="requestsOrdre" :pagination="requestsPagination" :callback="callback"/>
        </div>
        <div v-if="!loading && followersOrdre.length > 0" class="followers"
             :class="{'min-height': followersOrdre.length > followersPagination.per_page}">
            <followers-list></followers-list>
        </div>
        <div class="col-12" v-if="!loading && followersOrdre.length > followersPagination.per_page">
            <pagination :list="followersOrdre" :pagination="followersPagination" :callback="callback"/>
        </div>

    </div>
</template>

<script>
    import followersList from "./followersList";
    import followLoader from "./followLoader";
    import followerRequest from "./followerRequest";
    import {mapGetters, mapActions} from "vuex"

    export default {
        components: {followersList, followerRequest, followLoader},
        props: {
            user: {
                type: String,
            }
        },
        data() {
            return {
                loading: true,
                friends: [],
                request: [],
                ressource: this.$http,
            }
        },
        computed: {
            ...mapGetters(["followersPagination", "followersOrdre", "requestsPagination", "requestsOrdre"])
        },
        methods: {
            callback() {

            },
            ...mapActions(["getFollowers"])
        },
        mounted() {
            this.getFollowers({user: this.user, callback: () => this.loading = false});
        }

    }
</script>

<style scoped>
    .min-height {
        min-height: 500px;
    }
</style>
