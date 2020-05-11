<template>
    <div class="row friends-list">
        <h3>Les abbonements :</h3>
        <div class="col-12 ">
            <followers-item :key="followers.id" :friend="follower" v-for="follower in followers"/>
        </div>
    </div>
</template>

<script>
    import followersItem from "./followersItem";
    import {mapGetters} from "vuex";
    import {orderBy, slice} from "lodash"

    export default {
        components: {
            followersItem
        },
        data() {
            return {
                pagination: {
                    per_page: 5,    // required
                    current_page: 1, // required
                    last_page: 1    // required
                },
            }
        },
        computed: {
            ...mapGetters({
                followers: "followersPaginated"
            }),
        },
    }
</script>

<style scoped>

</style>
