<template>
    <form>
        <slot></slot>
    </form>
</template>

<script>
    export default {
        name: "VueForm",
        provide: function() {
            return {
                getError: this.getError,
                setError: this.setError
            }
        },
        data(){
            return {
                errors: {
                    name: "The name field is required."
                },
                foo:'bar'
            }
        },
        methods: {
            getError: function(name){
                return this.errors.hasOwnProperty(name) ? this.errors.name : null;
            },
            setError: function(name, value){
                this.errors.name = value;
            }
        },
    }
</script>

<style scoped>

</style>
