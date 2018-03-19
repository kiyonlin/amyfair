process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'

export default ({ app, store, redirect, $axios }) => {
    $axios.defaults.baseURL = process.env.API_URL || 'http://localhost:3000/api';

    $axios.onRequest(config => {
        console.log('set token')
        const token = store.getters['auth/token']

        if (token) {
            $axios.setToken(token, 'Bearer');
        }
    })

    $axios.onError(error => {
        const { status } = error.response || {}
        console.log('status', status)
        if (status >= 500) {
            console.log('500+ error')
        }
        console.log('check', store.getters['auth/check']);
        if (status === 401 && store.getters['auth/check']) {
            console.log('500+ error')

            store.dispatch('auth/logout')

            redirect({
                name: 'login'
            })
        }
        if (status >= 400) {
            console.log('400+ error')
        }
    })
}
