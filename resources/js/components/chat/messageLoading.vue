<template>
    <vue-content-loading :width="width" :height="height">
        <circle cx="9" cy="9" r="9"></circle>
        <rect x="22" y="0" rx="10" ry="10" :width="rectWidth" height="20"></rect>
        <rect x="22" y="22" rx="4" ry="4" width="30" height="03"></rect>
    </vue-content-loading>
</template>

<script>
    import VueContentLoading from 'vue-content-loading';

    export default {
        data() {
            return {
                width: 400,
                height: 31,
            }
        },
        props: {
            rectWidth: {
                type: Number,
                default: 100,
            },
        },
        components: {
            VueContentLoading
        }
    }
</script>

<style scoped>
</style>
