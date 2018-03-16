import axios from 'axios'

process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'

export default ({
    app,
    store,
    redirect
}) => {
    axios.defaults.baseURL = process.env.apiUrl + '/api'
    if (process.server) {
        return
    }

    axios.interceptors.request.use(request => {
        request.baseURL = process.env.apiUrl

        const token = store.getters['auth/token']

        if (token) {
            request.headers.common['Authorization'] = `Bearer ${token}`;
        }

        return request
    })

    axios.interceptors.response.use(response => response, error => {
        const {
            status
        } = error.response || {}

        if (status >= 500) {
            alert('500+ error')
        }
        if (status === 401 && store.getters['auth/check']) {
            alert('500+ error')

            store.dispatch('auth/logout')

            return redirect({
                name: 'login'
            })
        }

        return Promise.reject(error)
    })
}
