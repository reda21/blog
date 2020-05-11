<template>
    <div class="card-header msg_head">
        <div class="d-flex bd-highlight">
            <div class="img_cont">
                <img :src="conversation.participant.avatar" class="rounded-circle user_img">
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span>Chat with Khalid</span>
                <p>1767 Messages</p>
            </div>
        </div>
        <span id="action_menu_btn"><i class="fa fa-ellipsis-v"></i></span>
        <div class="action_menu">
            <ul>
                <li><i class="fa fa-user-circle"></i> View profile</li>
                <li><i class="fa fa-users"></i> Add to close friends</li>
                <li><i class="fa fa-plus"></i> Add to group</li>
                <li><i class="fa fa-ban"></i> Block</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            conversation: {
                type: Object
            },
        },
    }
</script>

<style scoped>

</style>
