export const state = () => ({
    locales: ['en', 'zh_cn'],
    locale: 'zh_cn'
})

export const mutations = {
    SET_LANG(state, locale) {
        if (state.locales.includes(locale)) {
            state.locale = locale
        }
    }
}
