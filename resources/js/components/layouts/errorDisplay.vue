<template>
    <div class="form-group">
        <label :for="name">
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
            name: {
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
                return this.validate.errors.length? true: false;
//                return this.validate.dirty && this.validate.invalid
            },
            error() {
                if (this.isInvalid) {
                    return this.validate.errors[0];
                }
                return "";
            }
        },
        data() {
            return {
                length: this.validate.errors.length,
                errors: this.validate.errors,
            }
        },
        provide: {
            foo: 'bar'
        },
    }
</script>

<style scoped>

</style>
