export default ({ store, redirect, app }) => {
    store.commit('lang/SET_LANG', 'zh_CN');
    app.i18n.locale = 'zh_CN';
    if (!store.getters['auth/check'] || !store.getters['auth/admin']) {
        return redirect('/admin/login')
    }
}
