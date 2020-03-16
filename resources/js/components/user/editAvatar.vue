<template>
    <div class="card my-3">
        <div class="card-header">
            Changer L'Avatar
        </div>
        <div class="card-body">
            <div class="card-img text-center">
                <img :src="user.avatar" alt="User profile picture" class="profile-user-img img-thumbnail img-circle">
            </div>
            <a @click.prevent="open" class="btn btn-primary btn-block">
                Uploader image profile
            </a>
            <upload field="avatar" @crop-upload-success="cropUploadSuccess" @crop-upload-fail="cropUploadFail"
                       v-model="show" :width="200" :height="200" :url="urlApi" :params="params" :noCircle="true"
                       lang-type="fr" method="POST" :noSquare="true"></upload>
        </div>
    </div>
</template>

<script>
    import myUpload from 'vue-image-crop-upload';
    import {debounce} from 'lodash';

    export default {
        name: "editAvatar",
        components: {myUpload},
        data() {
            return {
                user: {
                    avatar: "http://webmx2018.me/img/profil/default.jpg"
                },
                show: false,
                params: {
                    name: 'avatar',
                    method: "POST"
                },
                headers: {
                    smail: '*_~',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    common: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                },
                urlApi: ApiUrl + "/avatar"
            }
        },
        methods: {
            open() {
                this.show = true;
            },
            close(){
                this.show = false;
            },
            cropUploadSuccess(data, field) {
                console.log('-------- upload success --------');
                this.close();
                console.log({data: data.img});
            },

            cropUploadFail(status, field) {
                console.log('-------- upload fail --------');
                console.log(status);
                console.log('field: ' + field);
            },
            displayWindowSize() {
                // Get width and height of the window excluding scrollbars
                let w = document.documentElement.clientWidth;
                let h = document.documentElement.clientHeight;
                let el = window.$(".vue-image-crop-upload .vicp-wrap");
                if (w < 660) el.width(w - 45); else el.width(600);
                console.log({w, h, el});

            }
        },
        mounted() {
            // Attaching the event listener function to window's resize event
            window.addEventListener("resize", debounce(this.displayWindowSize, 250));

            // Calling the function for the first time
            this.displayWindowSize();
        }

    }
</script>

<style>
    .profile-user-img {
        width: 200px;
        margin: 15px auto;
    }

    .img-circle {
        border-radius: 50%;
    }

    .vue-image-crop-upload .vicp-wrap {
        width: 350px;
    }

</style>
