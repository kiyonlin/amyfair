import Vue from 'vue'
import VeeValidate, { Validator } from 'vee-validate';
import en from 'vee-validate/dist/locale/en'
import zh_CN from 'vee-validate/dist/locale/zh_CN'
import Rules from './validateRules';

export default ({ app, store }) => {

    const config = {
        // errorBagName: 'errors', // change if property conflicts
        fieldsBagName: 'vfields',
        delay: 100,
        // locale: app.i18n.locale,
        dictionary: { en, zh_CN },
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
        i18n: app.i18n, // the vue-i18n plugin instance
        i18nRootKey: 'validations' // the nested key under which the validation messages will be located
    };
    Vue.use(VeeValidate, config);

    // 注册自定义验证规则
    // 验证的 messages 在 locales中
    Object.keys(Rules).forEach(rule => {
        Validator.extend(rule, Rules[rule]);
    });
}
