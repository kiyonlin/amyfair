export default ({ store, redirect }) => {
    if (store.getters['auth/check'] && !store.getters['auth/admin']) {
        return redirect('/')
    }
}
