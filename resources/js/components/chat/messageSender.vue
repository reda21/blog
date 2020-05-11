<template>
    <div class="d-flex justify-content-start mb-4">
        <div class="img_cont_msg">
            <img :src="message.sender.avatar" class="rounded-circle user_img_msg">
        </div>
        <div class="msg_cotainer" v-html="message.body">
        </div>
        <span class="msg_time">{{message.created_at | date}}</span>
    </div>
</template>

<script>
    export default {
        props: {
            message: Object
        }
    }
</script>

<style scoped>
    .d-flex.justify-content-start{
        position: relative;
    }

    .msg_time {
        position: absolute;
        left: 60px;
        bottom: -15px;
        font-size: 10px;
    }
</style>
