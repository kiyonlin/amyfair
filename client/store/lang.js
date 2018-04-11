export const state = () => ({
    locales: ['en', 'zh_CN'],
    locale: 'en'
})

export const getters = {
    locale: state => state.locale,
    locales: state => state.locales,
}

export const mutations = {
    SET_LANG(state, locale) {
        if (state.locales.includes(locale)) {
            state.locale = locale
        }
    }
}
