<template>
    <div>
        {{ count }}
        <button @click="increment">Increment</button>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default {
        name: "foo",
        data() {
            return {
                count: 0
            }
        },

        methods: {
 /**           ...mapActions([
                'moduleActionClick'
            ]),*/
            increment() {
                this.count++
            },

        },
        computed: mapGetters([
            'moduleClicks'
        ])
    }
</script>
