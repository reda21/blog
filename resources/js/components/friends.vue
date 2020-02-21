<template>
    <div class="row mt-3">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <div class="row">
                <div class="col-6">
                    <b-button type="button" :block="true" @click="theAction" :loading="loadingBouton"
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
            follow: {
                type: Number
            },
            followingNbr: {
                type: Number,
                default: 0
            },
            followsNbr: {
                type: Number,
                default: 0
            },
            url: String

        },
        data() {
            return {
                followers: this.followsNbr,
                following: this.followingNbr,
                loadingBouton: false,
                textBouton: this.follow ? "Abonné" : "suivre",
                variant: this.follow ? "btn-outline-primary" : "btn-outline-secondary",
                isFreinds: this.follow ? true : false,
                resource: this.$resource(ApiUrl+"/user/"+ this.user.username,{},{
                    follow : {method:"POST",url: ApiUrl+"/user/"+ this.user.username+"/follow"},
                    unfollow : {method:"POST",url: ApiUrl+"/user/"+ this.user.username+"/unfollow"}
                })

            }
        },
        watch: {
            isFreinds(nval, oval) {
                if (nval) {
                    this.textBouton = "Abonné";
                    this.variant = "btn-outline-primary";
                } else {
                    this.textBouton = "suivre";
                    this.variant = "btn-outline-secondary";
                }
            }
        },
        methods: {
            theAction() {
                this.loadingBouton = true;
                if (this.isFreinds){
                    this.clickUnfollow(() =>{
                        this.isFreinds = false;
                        this.followers--;
                        this.loadingBouton = false;
                    })
                }else {
                    this.clickFollow(() =>{
                        this.isFreinds = true;
                        this.followers++;
                        this.loadingBouton = false;
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
            clickFollow(callback){
                this.resource.follow().then(response => {
                    callback();
                }, response => {
                    this.loadingBouton = false;
                    console.log({error: response})
                });
            },
            clickUnfollow(callback){
                this.resource.unfollow().then(response => {
                    callback();
                }, response => {
                    this.loadingBouton = false;
                    console.log({error: response})
                });
            },
        }
    };
</script>
