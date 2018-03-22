import Vue from 'vue'
import { result } from 'lodash'
export default ({ app, store }) => {
    Vue.filter('text', function(value, path) {
        return result(require(`~/locales/${app.i18n.locale}.json`), `${path}.${value}`, value);
    })
}
