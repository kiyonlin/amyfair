import Cookies from 'js-cookie'

export const state = () => ({
    user: null,
    token: null,
    refreshToken: null
})

export const getters = {
    user: state => state.user,
    token: state => state.token,
    refreshToken: state => state.refreshToken,
    check: state => state.user !== null,
    admin: state => state.user.admin || false,
}

export const mutations = {
    SET_TOKEN(state, token) {
        state.token = token
    },
    SET_REFRESH_TOKEN(state, refreshToken) {
        state.refreshToken = refreshToken
    },
    FETCH_USER_SUCCESS(state, user) {
        state.user = user
    },
    FETCH_USER_FAILURE(state) {
        state.token = null
    },

    LOGOUT(state) {
        state.user = null
        state.token = null
    },

    UPDATE_USER(state, { user }) {
        state.user = user
    }
}

export const actions = {
    saveToken({ commit, }, { token, remember }) {
        commit('SET_TOKEN', token)
        Cookies.set('token', token, {
            expires: remember ? 30 : null
        })
    },
    async fetchUser({ state, commit }) {
        try {
            const { data } = await this.$axios.$get('/user')
            console.log(data);
            commit('FETCH_USER_SUCCESS', data)
        } catch (e) {
            Cookies.remove('token')
            commit('FETCH_USER_FAILURE')
        }
    },
    updateUser({ commit }, payload) {
        commit('UPDATE_USER', payload)
    },
    async logout({ commit }) {
        try {
            await this.$axios.$get('/logout')
        } catch (e) {}
        Cookies.remove('token')
        commit('LOGOUT')
    }
}
