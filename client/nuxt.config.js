require('dotenv').config()

module.exports = {
    srcDir: __dirname,

    env: {
        apiUrl: process.env.APP_URL || 'http://amyfair.debug',
        appName: process.env.APP_NAME || 'Amy fair',
    },

    /*
     ** Headers of the page
     */
    head: {
        title: 'amyfair',
        meta: [{
            charset: 'utf-8'
        },
        {
            name: 'viewport',
            content: 'width=device-width, initial-scale=1'
        },
        {
            hid: 'description',
            name: 'description',
            content: 'amyfair'
        }],
        link: [{
            rel: 'icon',
            type: 'image/x-icon',
            href: '/favicon.ico'
        }]
    },
    /*
     ** Customize the progress bar color
     */
    loading: {
        color: '#3B8070'
    },
    /*
     ** Build configuration
     */
    build: {
        /*
         ** Run ESLint on save
         */
        extend(config, {
            isDev,
            isClient
        }) {
            if (isDev && isClient) {
                config.module.rules.push({
                    enforce: 'pre',
                    test: /\.(js|vue)$/,
                    loader: 'eslint-loader',
                    exclude: /(node_modules)/
                })
            }
        },
        vendor: ['vue-i18n'],
        extractCSS: true
    },
    modules: [
        'bootstrap-vue/nuxt'
    ],
    router: {
        middleware: ['locale', 'check-auth']
    },
    css: [
        '@fortawesome/fontawesome/styles.css',
    ],
    plugins: [
        '~plugins/i18n.js',
        '~plugins/axios.js',
        '~plugins/nuxt-client-init.js',
        '~plugins/fontawesome'
    ],
}
