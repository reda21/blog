<template>
    <div class="card my-3">
        <div class="card-header">
            Header
        </div>
        <div class="card-body">
            <ValidationObserver ref="form" v-slot="o">
                <form @submit.prevent="o.validate().then(onSubmit(o, $event))">
                    <validation-provider name="username" rules="required|min:6" v-slot="v">
                        <error-display name="username" label="Pseudo" :validate="v">
                            <input v-model="form.username" type="text" id="username" class="form-control"
                                   :class="{ 'is-invalid': v.errors.length }">
                        </error-display>
                    </validation-provider>
                    <validation-provider name="email" rules="required|email" v-slot="v">
                        <error-display name="email" label="E-Mail Address" :validate="v">
                            <input v-model="form.email" type="text" id="email" class="form-control"
                                   :class="{ 'is-invalid': v.errors.length }">
                        </error-display>
                    </validation-provider>
                    <validation-provider name="first_name" rules="required" v-slot="v">
                        <error-display name="first_name" label="Prénom" :validate="v">
                            <input v-model="form.first_name" type="text" id="first_name" class="form-control"
                                   :class="{ 'is-invalid': v.errors.length }">
                        </error-display>
                    </validation-provider>
                    <validation-provider name="last_name" rules="required" v-slot="v">
                        <error-display name="last_name" label="Nom" :validate="v">
                            <input v-model="form.last_name" type="text" id="last_name" class="form-control"
                                   :class="{ 'is-invalid': v.errors.length }">
                        </error-display>
                    </validation-provider>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">start</button>
                        </div>
                        <div class="col">
                            <button type="button" @click.prevent="testing" class="btn btn-lg btn-danger btn-block">end
                            </button>
                        </div>
                    </div>
                </form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
    import {onMounted} from "@vue/composition-api"
    import {ValidationProvider, ValidationObserver} from 'vee-validate';
    import {forEach} from "lodash"

    export default {
        setup(props, context){
            console.log({props, context})
        },
        components: {ValidationObserver, ValidationProvider},
        props: {
            user: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                form: {
                    username: this.user.username,
                    email: this.user.email,
                    first_name: this.user.first_name,
                    last_name: this.user.last_name,
                },
                userRessource: this.$resource(ApiUrl + "/account"),
            }
        },
        methods: {
            onSubmit(validate, event) {
                if (validate.valid) {
                    console.log({onSubmit: this.form});

                    this.save().then((response) => {
                        console.log({response: response.data});
                    }, (response) => {
                        console.log({response: response.data});
                        if (response.status == 422) {
                            forEach(response.data.errors, (value, key) => {
                                switch (key) {
                                    case "username":
                                        this.$refs.form.setErrors({
                                            username: value
                                        });
                                        break;

                                    case "email":
                                        this.$refs.form.setErrors({
                                            birthday: value
                                        });
                                        break;
                                    case "first_name":
                                        this.$refs.form.setErrors({
                                            first_name: value
                                        });
                                        break;
                                    case "last_name":
                                        this.$refs.form.setErrors({
                                            last_name: value
                                        });
                                        break;


                                }
                                this.$refs.form.setErrors({
                                    birthday: ['This email is already taken']
                                });
                            })
                        }
                        console.log({response: response.data});
                    });
                }
            },
            async save() {
                return await this.userRessource.save({}, this.form);
            },
            async testing() {
                await this.$refs.form.reset();
                this.href();
            },
            href(){
                let url = window.location.href;
                window.location.href = url;
            }
        }
    }
</script>

<style scoped>

</style>
