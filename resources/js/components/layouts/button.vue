<template>
    <button v-if="IsButton" class="btn" type="button" @click="click" :class="VariantText"
            :disabled="disabled || loading">
        <span v-if="loading" v-html="loadingText"></span>
        <slot v-else></slot>
    </button>
    <a :href="hrefTexte" class="btn" :target="target" :class="VariantText" @click.prevent="click" v-else
       :disabled="disabled || loading">
        <template v-if="loading" v-html="loadingText"></template>
        <slot v-else></slot>
    </a>
</template>

<style>
    .btn-outline-primary {
        color: #007bff;
        background-color: transparent;
        background-image: none;
        border-color: #007bff;
    }

    .btn-outline-primary:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-outline-success {
        color: #28a745;
        background-color: transparent;
        background-image: none;
        border-color: #28a745;
    }

    .btn-outline-success:hover {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }


    .btn-outline-warning {
        color: #ffc107;
        background-color: transparent;
        background-image: none;
        border-color: #ffc107;
    }

    .btn-outline-warning:hover {
        color: #fff;
        background-color: #ffc107;
        border-color: #ffc107;
    }


    .btn-outline-danger {
        color: #dc3545;
        background-color: transparent;
        background-image: none;
        border-color: #dc3545;
    }

    .btn-outline-danger:hover {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

loadingText
<script type="text/babel">
    export default {
        props: {
            href: String,
            target: {
                type: String,
                default: "_self"
            },
            activeClass: {
                type: String,
                default: ""
            },
            block: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            },
            loading: {
                type: Boolean,
                default: false
            },
            loadingText: {
                type: String,
                default: "<i class='fa fa-spinner fa-spin '></i> Processing Order"
            },
            size: {
                type: String,
                default: null,
                validator: size => arrayIncludes(["sm", "", "lg"], size)
            },
            variant: {
                type: String,
                default: ""
            },
            type: {
                type: String,
                default: "button"
            },
            pressed: {
                // tri-state prop: true, false or null
                // => on, off, not a toggle
                type: Boolean,
                default: null
            }
        },
        data(){
            return {}
        },
        computed: {
            IsButton()
            {
                if (this.type == "a") {
                    return false;
                }
                return true;
            }
            ,
            hrefTexte()
            {
                if (this.href)
                    return this.href;
                return "#"
            }
            ,
            VariantText()
            {
                // primary, secondary, success, warning, and danger.
                let text;
                if (this.variant == "primary")
                    text = "btn-primary";
                else if (this.variant == "secondary")
                    text = "btn-secondary";
                else if (this.variant == "success")
                    text = "btn-success";
                else if (this.variant == "warning")
                    text = "btn-warning";
                else if (this.variant == "danger")
                    text = "btn-danger";
                else if (this.variant == "default")
                    text = "btn-default";
                else if (this.variant == "btn-outline-primary")
                    text = "btn-outline-primary";
                else if (this.variant == "btn-outline-secondary")
                    text = "btn-outline-secondary";
                else if (this.variant == "btn-outline-success")
                    text = "btn-outline-success";
                else if (this.variant == "btn-outline-warning")
                    text = "btn-outline-warning";
                else if (this.variant == "btn-outline-danger")
                    text = "btn-outline-danger";
                else if (this.variant == "outline-default")
                    text = "btn-outline-default";
                else if (this.variant == "text-primary")
                    text = "btn-text-primary";
                else if (this.variant == "text-success")
                    text = "btn-text-success";
                else if (this.variant == "text-danger")
                    text = "btn-text-danger";
                else if (this.variant == "text-default")
                    text = "btn-text-default";
                else
                    text = 'primary';

                if (this.block)
                    text = text + ' btn-block';

                if (this.activeClass)
                    text = text + ' ' + this.activeClass;
                return text

            }
        },
        methods: {
            click(){
                console.log("j'ai clicker");
                this.$emit("click");
            }
        }
    }
</script>
