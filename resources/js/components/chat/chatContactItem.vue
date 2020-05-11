<template>
    <li :class="{active: false}"  v-tooltip.test="conversation.participant.username">
        <router-link :to="{ name: 'chat.show', params: { slug: conversation.participant.username }}">
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <img :src="conversation.participant.avatar" class="rounded-circle user_img">
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <span>{{conversation.participant.username}}</span>
                    <p>{{conversation.participant.username}} is {{'online'}}</p>
                </div>
            </div>
        </router-link>
    </li>
</template>

<script>
    export default {
        props: {
            conversation: {
                type: Object,
            },
        },
    }

</script>

<style scoped>

</style>
