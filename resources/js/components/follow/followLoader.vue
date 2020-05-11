<template>
    <div class="friends-item">
        <vue-content-loading :width="300" :height="20">
            <circle cx="9" cy="10" r="9"/>
            <rect x="25" y="4" rx="4" ry="4" width="100" height="05"/>
            <rect x="25" y="12" rx="4" ry="4" width="100" height="05"/>
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

<style>

</style>
