<template>
    <div class="friends-item">
        <div class="row">
            <div class="col-md-6">
                <div class="friends-img pull-left">
                    <img :src="item.avatar" alt="User Image" class="img-circle img-sm">
                </div>
                <div class="friends-body">
                    <a :href="item.url">{{item.username}}</a>
                    <p>{{item.fullname}}</p>
                </div>
            </div>
            <div class="col-md-6 botton-user text-right pt-3">
                <b-button type="button" @click="confirmed" :loading="loadingConfirmed" variant="btn-outline-primary">
                    <i class="fa fa-user"></i> Confirmer
                </b-button>
                <b-button type="button" @click="reset" :loading="loadingReset" variant="btn-outline-secondary">
                    <i class="fa fa-user"></i> Supprimer
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from "vuex"
    export default {
        props: {
            item: Object,
        },
        data() {
            return {
                loadingConfirmed: false,
                loadingReset: false,
                name: ""
            }
        },
        methods: {
            confirmed() {
                this.loadingConfirmed = true;
                this.confirmedRequest({username:this.item.username,  callback: () => this.loadingConfirmed = false});
            },
            reset() {
                this.loadingReset = true;
                this.ressetRequest({username:this.item.username,  callback: () => this.loadingReset = false});
            },
            ...mapActions(['confirmedRequest', "ressetRequest"])

        },
    }
</script>

<style scoped>

</style>
