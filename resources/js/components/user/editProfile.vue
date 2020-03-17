<template>
    <div class="card my-3">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <ValidationObserver ref="form" v-slot="validate">
                <form @submit.prevent="onSubmit(validate, $event)">
                    <div class="form-group">
                        <label for="location">Pays</label>
                        <select v-model="form.location" class="form-control" name="location" id="location">
                            <option v-for="(contry, key) in listLocation" v-bind:value="key">
                                {{ contry }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Gendre</label>
                        <select v-model="form.sexe" class="form-control" name="sexe" id="sexe">
                            <option v-for="(sexe, key) in sexeList" v-bind:value="key">
                                {{ sexe }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cacher l'email</label>
                        <div class="custom-control custom-switch">
                            <input v-model="form.email_hidden" type="checkbox" class="custom-control-input"
                                   name="email_hidden" id="email_hidden">
                            <label class="custom-control-label" for="email_hidden"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="facebook_username">Pseudo Facebook</label>
                        <input v-model="form.facebook_username" type="text" name="facebook_username"
                               id="facebook_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="twitter_username">Pseudo Twitter</label>
                        <input v-model="form.twitter_username" type="text" name="twitter_username" id="twitter_username"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pinterest_username">Pseudo Pinterest</label>
                        <input v-model="form.pinterest_username" type="text" name="pinterest_username"
                               id="pinterest_username"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="google_plus_username">Pseudo Google Plus</label>
                        <input v-model="form.google_plus_username" type="text" name="google_plus_username"
                               id="google_plus_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="dribbble_username">Pseudo Dribbble</label>
                        <input v-model="form.dribbble_username" type="text" name="dribbble_username"
                               id="dribbble_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="github_username">Psuedo Guthub</label>
                        <input v-model="form.github_username" type="text" name="github_username" id="github_username"
                               class="form-control">
                    </div>
                    <validation-provider name="birthday" :rules="rules" v-slot="v">
                        <error-display name="birthday" label="Date de naissance" :validate="v">
                            <date-picker v-model="form.birthday" id="birthday" :config="options"
                                         :class="{ 'is-invalid': v.errors.length }"/>
                        </error-display>
                    </validation-provider>

                    <div class="form-group">
                        <label for="bio">Example textarea</label>
                        <textarea class="form-control" v-model="form.bio" name="bio" id="bio" rows="3"/>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary btn-block">start</button>
                        </div>
                        <div class="col">
                            <button type="button" @click.prevent="testing" class="btn btn-outline-danger btn-block">end
                            </button>
                        </div>
                    </div>
                </form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
    import {ValidationProvider, ValidationObserver} from 'vee-validate';
    // Import this component
    import datePicker from 'vue-bootstrap-datetimepicker';
    // Import date picker css
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    import Contries from "./contrys.json"


    export default {
        components: {ValidationProvider, ValidationObserver, datePicker},
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                form: {
                    location: this.user.location,
                    sexe: this.user.sexe,
                    email_hidden: this.user.email_hidden,
                    facebook_username: this.user.facebook_username,
                    twitter_username: this.user.twitter_username,
                    pinterest_username: this.user.pinterest_username,
                    google_plus_username: this.user.google_plus_username,
                    dribbble_username: this.user.dribbble_username,
                    github_username: this.user.github_username,
                    birthday: this.user.birthday,
                    bio: this.user.bio,
                },
                userRessource: this.$resource(ApiUrl + "/profile"),
                rules: 'required|date_format:\'DD/MM/YYYY\'|date_between:\'01/01/1900\',' + moment().format('DD/MM/YYYY') + '\'',
                listLocation: Contries,
                sexeList: {'-': '--', 'm': 'Homme', 'f': 'Femme'},


                options: {
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                    maxDate: new Date(),
                    minDate: new Date(1900, 1, 1),
                    locale: 'fr'
                }
            }
        },
        methods: {

            onSubmit(...event) {
                console.log({event, ref: this.$refs})
                //         this.$refs.form.setErrors({email: ["je suis un beau error"]})

                this.save().then((response) => {
                    console.log({response: response.data});
                }, (response) => {
                    console.log({response: response.data});
                });
            },
            async save() {
                return await this.userRessource.save({}, this.form);
            },
            testing() {
                this.$refs.form.setErrors({
                    birthday: ['This email is already taken']
                });
            },
            href(){
                let url = window.location.href;
                window.location.href = url;
            }
        },
        computed: {},
        mounted() {

        }
    }
</script>
