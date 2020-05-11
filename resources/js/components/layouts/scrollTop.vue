<template>
    <a href="#header" @click.prevent="scrollTop" :class="{show: show}" class="scrollup"><i class="fa fa-chevron-up"></i></a>
</template>

<style lang="scss">
    a.scrollup {
        position: fixed;
        right: 10px;
        bottom: 10px;
        z-index: 9999;
        width: 32px;
        height: 32px;
        background: #c00;
        color: #fff;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        line-height: 32px;
        opacity: 0;
    }

    a.scrollup.show {
        z-index: 2;
        opacity: .5;

        &:hover {
            opacity: 1;
        }
    }
</style>

<script>
    import throttle from "lodash/throttle";

    export default {
        data() {
            return {
                visible: true,
                windows: $(window).scrollTop(),
                scrollTrigger: 100,
            }
        },
        computed: {
            show() {
                return (this.windows > this.scrollTrigger && this.visible);
            }
        },
        methods: {
            scrollTop(e) {
                $('html,body').animate({
                    scrollTop: 0
                }, 700);
            }
        },
        mounted() {
            let data, that = this;
            window.addEventListener('scroll', throttle((e) => {
                data = $(window).scrollTop();

                that.windows = data;
            }, 50))
        }

    }
</script>
