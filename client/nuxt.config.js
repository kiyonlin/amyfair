const PurgecssPlugin = require('purgecss-webpack-plugin')
const glob = require('glob-all')
const path = require('path')

module.exports = {
    srcDir: __dirname,

    env: {
        apiUrl: process.env.APP_URL || 'http://amyfair-api.debug',
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
            }
        ],
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
            if (!isDev) {
                // Remove unused CSS using purgecss. See https://github.com/FullHuman/purgecss
                // for more information about purgecss.
                config.plugins.push(
                    new PurgecssPlugin({
                        paths: glob.sync([
                            path.join(__dirname, './pages/**/*.vue'),
                            path.join(__dirname, './layouts/**/*.vue'),
                            path.join(__dirname, './components/**/*.vue')
                        ]),
                        whitelist: ['html', 'body']
                    })
                )
            }
        },
        vendor: ['vue-i18n'],
    },
    css: [
        // 'tailwindcss/css/tailwind.css'
    ],
    modules: [
        'bootstrap-vue/nuxt'
    ],
    router: {
        middleware: 'i18n'
    },
    plugins: ['~/plugins/i18n.js'],
}
