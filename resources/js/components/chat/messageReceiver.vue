<template>
    <div class="d-flex justify-content-end mb-4">
        <div class="msg_cotainer_send">
            {{message.body}}
        </div>
        <span class="msg_time_send">{{message.created_at | date}}</span>
        <div class="img_cont_msg">
            <img :src="message.sender.avatar" class="rounded-circle user_img_msg">
        </div>
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
    .d-flex.justify-content-end {
        position: relative;
    }

    .msg_time_send {
        position: absolute;
        right: 60px;
        bottom: -15px;
        font-size: 10px;
    }
</style>
