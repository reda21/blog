<template>
   <div>
       <div class="row friends-list">
           <h3>Les abonnés :</h3>
           <div class="col-lg-12 ">
               <following-item :key="following.id" :friend="following" v-for="following in followings"/>
           </div>
       </div>

   </div>
</template>

<script>
    import followingItem from "./followingItem";
    import {orderBy, slice} from "lodash"
    import {mapGetters, mapActions} from "vuex"

    export default {
        components: {
            followingItem,
        },
        data(){
            return {
            }
        },
        computed:{
            ...mapGetters({
                followings:"followingsPaginated",
            })
        },
    }
</script>

<style scoped>

</style>
