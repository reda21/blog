<template>
    <div class="form-group">
        <label>
            {{label}}
        </label>
        <slot></slot>
        <span v-if="isInvalid" role="alert" class="invalid-feedback"><strong>{{error}}</strong></span>
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                default: ""
            },
            validate: {
                type: Object,
                default: {
                    dirty: false,
                    invalid: false,
                    errors: null
                }
            },
        },
        computed: {
            isInvalid() {
                return this.validate.dirty && this.validate.invalid
            },
            error() {
                if (this.validate.errors) {
                    return this.validate.errors[0];
                }
                return "";
            }
        },
        provide: {
            foo: 'bar'
        },
    }
</script>

<style scoped>

</style>
