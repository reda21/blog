<template>
    <div class="card-header msg_head">
        <vue-content-loading :width="300" :height="29.5">
            <circle cx="13.5" cy="13.5" r="13.5"/>
            <rect x="35" y="4" rx="4" ry="4" width="80" height="08"/>
            <rect x="35" y="16" rx="4" ry="4" width="30" height="03"/>
        </vue-content-loading>
    </div>
</template>

<script>
    import VueContentLoading from 'vue-content-loading';

    export default {
        components: {
            VueContentLoading
        }
    }
</script>

<style scoped>
    .card-header {
        height: 95px;
    }
</style>
