<template>
    <b-container>
        <b-row align-h="center">
            <b-col md="8" lg="8" sm="12">
                <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                    <b-form-group id="fullNameGroup" :label="$t('invitation.fullNameLabel')" label-for="fullName">
                        <b-form-input id="fullName" :name="$t('invitation.fullNameLabel')" v-model="form.fullName"
                                      v-validate.initial="'required'"
                                      :state="!errors.has($t('invitation.fullNameLabel'))"
                                      :placeholder="$t('invitation.fullNamePlaceholder')">
                        </b-form-input>
                        <b-form-invalid-feedback>{{ errors.first($t('invitation.fullNameLabel')) }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group id="corpNameGroup" :label="$t('invitation.corpNameLabel')" label-for="corpName">
                        <b-form-input id="corpName" :name="$t('invitation.corpNameLabel')" v-model="form.corpName"
                                      v-validate.initial="'required'"
                                      :state="!errors.has($t('invitation.corpNameLabel'))"
                                      :placeholder="$t('invitation.corpNamePlaceholder')">
                        </b-form-input>
                        <b-form-invalid-feedback>{{ errors.first($t('invitation.corpNameLabel')) }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group id="countryGroup" :label="$t('invitation.countryLabel')" label-for="country">
                        <b-form-input id="country" :name="$t('invitation.countryLabel')" v-model="form.country"
                                      v-validate.initial="'required'"
                                      :state="!errors.has($t('invitation.countryLabel'))"
                                      :placeholder="$t('invitation.countryPlaceholder')">
                        </b-form-input>
                        <b-form-invalid-feedback>{{ errors.first($t('invitation.countryLabel')) }}
                        </b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group id="mobileGroup" :label="$t('invitation.mobileLabel')" label-for="mobile">
                        <b-form-input id="mobile" :name="$t('invitation.mobileLabel')" v-model="form.mobile"
                                      v-validate.initial="'required'"
                                      :state="!errors.has($t('invitation.mobileLabel'))"
                                      :placeholder="$t('invitation.mobilePlaceholder')">
                        </b-form-input>
                        <b-form-invalid-feedback>{{ errors.first($t('invitation.mobileLabel')) }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group id="emailGroup" :label="$t('invitation.emailLabel')" label-for="email">
                        <b-form-input id="email" :name="$t('invitation.emailLabel')" v-model="form.email"
                                      v-validate.initial="'required|email'"
                                      :state="!errors.has($t('invitation.emailLabel'))"
                                      :placeholder="$t('invitation.emailPlaceholder')">
                        </b-form-input>
                        <b-form-invalid-feedback>{{ errors.first($t('invitation.emailLabel')) }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group id="passportNoGroup" :label="$t('invitation.passportNoLabel')" label-for="passportNo">
                        <b-form-input id="passportNo" :name="$t('invitation.passportNoLabel')" v-model="form.passportNo"
                                      v-validate.initial="'required|passport_no'"
                                      :state="!errors.has($t('invitation.passportNoLabel'))"
                                      :placeholder="$t('invitation.passportNoPlaceholder')">
                        </b-form-input>
                        <b-form-invalid-feedback>{{ errors.first($t('invitation.passportNoLabel')) }}
                        </b-form-invalid-feedback>
                    </b-form-group>

                    <b-form-group id="industryGroup" :label="$t('invitation.industryLabel')" label-for="industry">
                        <b-form-input id="industry" :name="$t('invitation.industryLabel')" v-model="form.industry"
                                      v-validate.initial="'required'"
                                      :state="!errors.has($t('invitation.industryLabel'))"
                                      :placeholder="$t('invitation.industryPlaceholder')">
                        </b-form-input>
                        <b-form-invalid-feedback>{{ errors.first($t('invitation.industryLabel')) }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group :label="$t('invitation.genderLabel')">
                        <b-form-radio-group v-model="form.gender" :options="'gendersText' | text('invitation')"
                                            name="gender">
                        </b-form-radio-group>
                    </b-form-group>
                    <b-form-group id="phoneGroup" :label="$t('invitation.phoneLabel')" label-for="phone">
                        <b-form-input id="phone" v-model="form.phone" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>
                    <div class="p-2">
                        {{$t('invitation.imList')}}
                    </div>
                    <b-form-group id="qqGroup" :label="$t('invitation.qqLabel')" label-for="qq">
                        <b-form-input id="qq" v-model="form.qq" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>
                    <b-form-group id="wechatGroup" :label="$t('invitation.wechatLabel')" label-for="wechat">
                        <b-form-input id="wechat" v-model="form.wechat" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>
                    <b-form-group id="whatsappGroup" :label="$t('invitation.whatsappLabel')" label-for="whatsapp">
                        <b-form-input id="whatsapp" v-model="form.whatsapp" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>
                    <b-form-group id="skypeGroup" :label="$t('invitation.skypeLabel')" label-for="skype">
                        <b-form-input id="skype" v-model="form.skype" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>
                    <b-form-group id="facebookGroup" :label="$t('invitation.facebookLabel')" label-for="facebook">
                        <b-form-input id="facebook" v-model="form.facebook" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="corpAddrGroup" :label="$t('invitation.corpAddrLabel')" label-for="corpAddr">
                        <b-form-input id="corpAddr" v-model="form.corpAddr" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>
                    <b-form-group id="websiteGroup" :label="$t('invitation.websiteLabel')" label-for="website">
                        <b-form-input id="website" v-model="form.website" :placeholder="$t('invitation.optional')">
                        </b-form-input>
                    </b-form-group>
                    <b-form-group id="sourceGroup" :label="$t('invitation.sourceLabel')" label-for="source">
                        <b-form-select id="source" v-model="form.source" :options="'sourcesText' | text('invitation')">
                            <option value="undefined">{{ $t("invitation.selectDefaultOptionOptional") }}</option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group id="intentGroup" :label="$t('invitation.intentLabel')" label-for="intent">
                        <b-form-select id="intent" v-model="form.intent" :options="'intentsText' | text('invitation')">
                            <option value="undefined">{{ $t("invitation.selectDefaultOptionOptional") }}</option>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group id="tradingIntroGroup" :label="$t('invitation.tradingIntroLabel')"
                                  label-for="tradingIntro">
                        <b-form-textarea id="tradingIntro" v-model="form.tradingIntro" :rows="5" :max-rows="5"
                                         :placeholder="$t('invitation.optional')">
                        </b-form-textarea>
                    </b-form-group>
                    <b-button type="submit" variant="primary" :disabled="!canSubmit" class="m-3">{{$t('btn.submit')}}
                    </b-button>
                    <b-button type="reset" variant="danger" class="m-3">{{$t('btn.reset')}}</b-button>
                </b-form>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import swal from "sweetalert2";

    export default {
        // layout: "none",
        head () {
            return {
                title:
                    this.$t("invitation.title") + " - " + this.$t("invitation.register")
            };
        },
        data () {
            return {
                show: true,
                type: null,
                form: {},
                intentOptions: []
            };
        },
        created () {
            this.form.type = this.$route.query.type;
            this.$axios.$get("exhibitions/invitations").then(({data}) => {
                this.intentOptions = data;
            })
            ;
        },
        computed: {
            canSubmit () {
                return this.$validator.errors.items.length == 0;
            },
            intentOptionTextField () {
                return this.$i18n.locale == "en" ? "name_en" : "name";
            }
        },
        methods: {
            onSubmit (evt) {
                evt.preventDefault();
                this.$validator.validateAll().then(async
                    result => {
                        if (result) {
                            await
                                this.$axios.$post("invitations", this.form);
                            swal({
                                type: "success",
                                text: this.$i18n.t("invitation.added"),
                                timer: 1500
                            }).then(_ => {
                                this.$router.push({
                                    path: this.$i18n.path("")
                                });
                            })
                            ;
                            return;
                        }
                        // scroll to first validate error
                        this.$el
                            .querySelector(
                                '[data-vv-id="' + this.$validator.errors.items[0].id + '"]'
                            )
                            .scrollIntoView(false);
                    }
                );
            },
            onReset (evt) {
                evt.preventDefault();
                /* Reset our form values */
                this.form = {};
                /* Trick to reset/clear native browser form validation state */
                this.show = false;
                this.$nextTick(() => {
                    this.show = true;
                });
            }
        }
    };
</script>
