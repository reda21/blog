<template>
    <div class="row" :class="unit? 'mt-3' : ''">
        <div :class="unit? 'col-md-6' : 'col-12'">
            <div class="row">
                <div class="col-6">
                    <div class="description-block text-center">
                        <h5 class="description-header">
                            <a href="http://webmx2018.me/user/redmax/followers">{{followers}}</a>
                        </h5>
                        <span class="description-text">Abonnements</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="description-block text-center">
                        <h5 class="description-header">
                            <a href="http://webmx2018.me/user/redmax/following">{{following}}</a>
                        </h5>
                        <span class="description-text">Abonnés</span>
                    </div>
                </div>
            </div>
        </div>
        <div :class="unit? 'col-md-6' : 'col-12'">
            <div class="row">
                <div class="col-6">
                    <b-button v-if="user.activate" type="button" :block="true" @click="theAction"
                              :loading="loadingBouton"
                              :variant="variant">
                        <i class="fa fa-user-plus"></i> {{textBouton}}
                    </b-button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-outline-primary btn-block">
                        <i class="fa fa-envelope"></i> Message
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object,
            friends: Object,
            unit: {
                type: Boolean,
                defaults: false
            }
        },
        data() {
            return {
                followers: this.friends.follows,
                following: this.friends.following,
                loadingBouton: false,
                textBouton: "suivre",
                variant: "btn-outline-secondary",
                status: this.friends.status,
                resourceUrl: ApiUrl + "/user/" + this.user.usename,
            }
        },
        watch: {
            status(nval, oval) {
                console.log({nval, oval})
                this.changeButton(this.friends);
            }
        },
        methods: {
            update(data){
                this.status = this.friends.status = data.status;
                this.friends.return = data.return,
                this.following = data.following;
                this.followers = data.follows;
                this.loadingBouton = false;
            },
            theAction() {
                if (!this.user.activate) return false
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
                /*
                window.confirms("vous vouller annuler?", () => {
                    let self = this;
                    this.loadingBouton = true;
                    setTimeout(() => {
                        self.loadingBouton = false;
                        self.isFreinds = !self.isFreinds;
                        if (self.isFreinds)
                            this.followers++
                        else
                            this.followers--
                    }, 3000)
                }, () => {
                    console.log("no");
                })
*/
            },
            clickFollow(callback) {
                if (!this.user.activate) return false
                this.$http.post(this.resourceUrl + "/follow").then(response => {
                    callback(response.data);
                }, response => {
                    this.loadingBouton = false;
                    console.log({error: response})
                });
            },
            clickUnfollow(callback) {
                if (!this.user.activate) return false
                this.$http.post(this.resourceUrl + "/unfollow").then(response => {
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
            this.changeButton(this.friends);
        }
    };
</script>
