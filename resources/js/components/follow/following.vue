<template>
    <div class="friends">
        <follow-loader v-if="loading"></follow-loader>
        <follow-loader v-if="loading"></follow-loader>
        <follow-loader v-if="loading"></follow-loader>
        <div class="following" v-if="!loading"  :class="{'min-height': followings.length > pagination.per_page}">
            <following-list :friends="friends" ></following-list>
        </div>
        <div class="col-12" v-if="!loading && followings.length > pagination.per_page">
            <pagination :list="followings" :pagination="pagination" :callback="callback"/>
        </div>
    </div>
</template>

<script>
    import followingList from "./followingList";
    import followLoader from "./followLoader";
    import {mapGetters, mapActions} from "vuex"

    export default {
        components: {followingList, followLoader},
        props: {
            user: {
                type: String,
            }
        },
        data() {
            return {
                loading: true,
                friends: [],
                ressource: this.$http,
            }
        },
        computed: {
            ...mapGetters({
                followings:"followingsOrdre",
                pagination: "followingsPagination",
            })
        },
        methods: {
            callback(){

            },
            ...mapActions(["getFollowings"])
        },
        mounted() {
            this.getFollowings({user: this.user, callback: () => this.loading = false});
        }

    }
</script>

<style scoped>
    .min-height {
        min-height: 500px;
    }
</style>
