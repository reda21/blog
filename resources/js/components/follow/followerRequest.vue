<template>
    <div class="friends-list friends-request">
        <h3>Demande abonnement :</h3>
        <div class="row">
            <div class="col-lg-12 ">
                <follower-request-item :key="request.id" @confirmed="confirmed" :item="request" v-for="request in requests"/>
            </div>
        </div>
    </div>
</template>

<script>
    import followerRequestItem from "./followingRequestItem"
    import {mapGetters} from "vuex";
    import orderBy from "lodash/orderBy"

    export default {
        components: {
            followerRequestItem
        },
        data() {
            return {
                list: [
                    {
                        id: 1,
                        username: "justus74",
                        fullName: "jus le max",
                        url: "https://webmx.herokuapp.com/img/profil/default.jpg",
                    }
                ]
            }
        },
        computed:{
            ...mapGetters([ "requests"]),
            requestsOrdre(){
                return orderBy(this.requests, ['date'], ['desc']);
            }
        },
        methods: {
            confirmed(id) {
                this.request.splice(id, 1);
            },
            reset(id) {
                this.request.splice(id, 1);
            }
        }
    }
</script>

<style scoped>
    .friends-request {
        margin-top: 10px;
        margin-bottom: 20px;
    }
</style>
