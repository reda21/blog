<template>
    <div>
        Name:<br>
        <input type="text" name="name" @change="setError('name', 'This is a custom error message')"><br><br>
        <span class="help-text danger" v-text="getError('name')"></span>
    </div>
</template>

<script>
    export default {
        inject: {
            getError: {
                from: "getError",
            },
            setError: {
                from: "setError"
            },
            foo: {default: 'foo'},

        },
    }
</script>

<style scoped>

</style>
