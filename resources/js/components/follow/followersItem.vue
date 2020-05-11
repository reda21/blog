<template>
    <div class="friends-item">
        <div class="row">
            <div class="col-md-6">
                <div class="friends-img pull-left">
                    <img :src="friend.avatar" alt="User Image" class="img-circle img-sm">
                </div>
                <div class="friends-body">
                    <a :href="friend.url">{{friend.username}}</a>
                    <p>{{friend.fullname}}</p>
                </div>
            </div>
            <div class="col-md-6 botton-user text-right pt-3">
                <b-button v-if="activate" type="button" @click="theAction" :loading="loadingBouton" :variant="variant">
                    <i class="fa fa-user"></i> {{textBouton}}
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex"

    export default {
        props: {
            friend: Object
        },
        data(){
            return{
                loadingBouton: false,
                textBouton: "suivre",
                variant: "btn-outline-secondary",
                status: this.friend.status.status
            }
        },
        watch: {
            status(nval, oval) {
                console.log({nval, oval})
                this.changeButton(this.friend.status);
            }
        },
        computed:{
            activate(){
                return this.myProfile.id != this.friend.id;
            },
            ...mapGetters(["myProfile"])
        },
        methods:{
            update(data) {
                this.status = this.friend.status.status = data.status;
                this.friend.status.following = data.following;
                this.friend.status.followers = data.follows;
                //      this.friends.return = data.return,
                this.loadingBouton = false;


            },
            theAction(){
                if (!this.activate) return false
                this.loadingBouton = true;

                if (this.status == 2) {
                    this.clickUnfollow(({data}) => {
                        console.log({clickUnfollow: data});
                        this.update(data);
                    })
                } else {
                    this.clickFollow(({data}) => {
                        console.log({clickFollow: data});
                        this.update(data);
                    })
                }
            },
            clickFollow(callback) {
                if (!this.activate) return false
                this.$http.post("user/" + this.friend.username + "/follow").then(response => {
                    callback(response.data);
                }, response => {
                    this.loadingBouton = false;
                    console.log({error: response})
                });
            },
            clickUnfollow(callback) {
                if (!this.activate) return false
                this.$http.post("user/" + this.friend.username + "/unfollow").then(response => {
                    callback(response.data);
                }, response => {
                    this.loadingBouton = false;
                    console.log({error: response})
                });
            },
            changeButton(friends) {
                switch (friends.status) {
                    case 1:
                        this.textBouton = (friends.return) ? "S’abonner en retour" : "S’abonner";

                        this.variant = "btn-outline-secondary";
                        break;
                    case 2:
                        this.textBouton = "Abonné(e)";
                        this.variant = "btn-outline-primary";
                        break;
                    case 3:
                        this.textBouton = "demande envoyée";
                        this.variant = "btn-outline-secondary";
                        break;
                }
            }
        },
        mounted() {
            console.log({status: this.status});
            this.changeButton(this.friend.status);
        }
    }
</script>

<style scoped>

</style>
