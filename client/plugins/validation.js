import Vue from 'vue'
import VeeValidate, { Validator } from 'vee-validate';

export default ({ app, store }) => {
    Validator.localize(app.i18n.locale);

    const config = {
        // errorBagName: 'errors', // change if property conflicts
        // fieldsBagName: 'fields',
        delay: 100,
        // locale: app.i18n.locale,
        // dictionary: null,
        // strict: true,
        // classes: false,
        // classNames: {
        //     touched: 'touched', // the control has been blurred
        //     untouched: 'untouched', // the control hasn't been blurred
        //     valid: 'valid', // model is valid
        //     invalid: 'invalid', // model is invalid
        //     pristine: 'pristine', // control has not been interacted with
        //     dirty: 'dirty' // control has been interacted with
        // },
        // events: 'input|blur',
        // inject: true,
        // validity: false,
        // aria: true,
        // i18n: null, // the vue-i18n plugin instance
        // i18nRootKey: 'validations' // the nested key under which the validation messages will be located
    };
    Vue.use(VeeValidate, config);
}
