<template>
    <div class="card my-3">
        <div class="card-header">
            Changer le cover
        </div>
        <div class="card-body">
            <div class="card-img text-center">
                <img :src="img" alt="User profile picture" class="cover-user-img img-thumbnail">
            </div>
            <button @click.prevent="open" class="btn btn-outline-primary btn-block">
                Uploader image profile
            </button>
            <upload field="cover" @crop-upload-success="cropUploadSuccess" @crop-upload-fail="cropUploadFail"
                    v-model="show" :width="1000" :height="300" :url="urlApi" :params="params" noCircle noSquare
                    lang-type="fr" method="POST"></upload>
        </div>
    </div>
</template>

<script>
    import myUpload from 'vue-image-crop-upload';
    import {debounce} from 'lodash';

    export default {
        name: "editCover",
        components: {myUpload},
        props: {
            img: String
        },
        data() {
            return {
                show: false,
                params: {
                    name: 'cover',
                    method: "POST"
                },
                noCircle: true,
                headers: {
                    smail: '*_~',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    common: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                },
                urlApi: ApiUrl + "/cover"
            }
        },
        methods: {
            open() {
                this.show = true;
            },
            close() {
                this.show = false;
            },
            cropUploadSuccess(data, field) {
                console.log('-------- upload success --------');
                this.close();
                this.href();
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

            },
            href(){
                let url = window.location.href;
                window.location.href = url;
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
    .cover-user-img {
        margin: 15px auto;
    }

    .img-circle {
        border-radius: 50%;
    }

    .vue-image-crop-upload .vicp-wrap {
        width: 350px;
    }

</style>
