<template>
    <li>
        <vue-content-loading :width="width" :height="height">
            <circle :cx="circle.cx" :cy="circle.cy" :r="circle.r"/>
            <rect v-if="!innerWidth < 736" :x="rect1.x" :y="rect1.y" :rx="rect1.rx"
                  :ry="rect1.ry" :width="rect1.width" :height="rect1.height"/>
            <rect v-if="!innerWidth < 736" :x="rect2.x" :y="rect2.y" :rx="rect2.rx"
                  :ry="rect2.ry" :width="rect2.width" :height="rect2.height"/>
        </vue-content-loading>

    </li>
</template>

<script>
    import VueContentLoading from 'vue-content-loading';
    import throttle from "lodash/throttle";

    export default {
        data() {
            return {
                height: 35.5,
                innerWidth: window.innerWidth,
                circle: {
                    cx: 16,
                    cy: 16,
                    r: 16
                },
                rect1: {
                    x: 35,
                    y: 4,
                    rx: 4,
                    ry: 4,
                    width: 40,
                    height: 8
                },
                rect2: {
                    x: 35,
                    y: 18,
                    rx: 4,
                    ry: 4,
                    width: 27,
                    height: 4
                },
            }
        },
        computed: {
            width() {
                console.log({height: this.innerWidth})
                if (this.innerWidth < 736)
                    return 34;
                return 81;
            }
        },
        components: {
            VueContentLoading
        },
        mounted() {
            window.addEventListener('resize', throttle((e) => {
                this.innerWidth = window.innerWidth;
            }, 50))
        }
    }
</script>

<style>
    @media screen and (max-width: 735px) {
        .chat .card.chat-menu:hover {
            max-width: 75px;
            flex: 0 0 75px;
        }
    }

</style>
