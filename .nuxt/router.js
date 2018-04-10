import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const _e1ecc774 = () => import('../client/pages/invitation/index.vue' /* webpackChunkName: "pages/invitation/index" */).then(m => m.default || m)
const _b88923da = () => import('../client/pages/about.vue' /* webpackChunkName: "pages/about" */).then(m => m.default || m)
const _b24d20d0 = () => import('../client/pages/admin/index.vue' /* webpackChunkName: "pages/admin/index" */).then(m => m.default || m)
const _6ca3ac4e = () => import('../client/pages/setting/index.vue' /* webpackChunkName: "pages/setting/index" */).then(m => m.default || m)
const _10432770 = () => import('../client/pages/setting/profile.vue' /* webpackChunkName: "pages/setting/profile" */).then(m => m.default || m)
const _708112af = () => import('../client/pages/admin/login.vue' /* webpackChunkName: "pages/admin/login" */).then(m => m.default || m)
const _ae525746 = () => import('../client/pages/admin/dashboard/index.vue' /* webpackChunkName: "pages/admin/dashboard/index" */).then(m => m.default || m)
const _58a884f4 = () => import('../client/pages/admin/invitation/index.vue' /* webpackChunkName: "pages/admin/invitation/index" */).then(m => m.default || m)
const _098bb7a8 = () => import('../client/pages/auth/login.vue' /* webpackChunkName: "pages/auth/login" */).then(m => m.default || m)
const _42e19099 = () => import('../client/pages/admin/setting/index.vue' /* webpackChunkName: "pages/admin/setting/index" */).then(m => m.default || m)
const _51487530 = () => import('../client/pages/auth/register.vue' /* webpackChunkName: "pages/auth/register" */).then(m => m.default || m)
const _79de3738 = () => import('../client/pages/invitation/create.vue' /* webpackChunkName: "pages/invitation/create" */).then(m => m.default || m)
const _2a836280 = () => import('../client/pages/admin/invitation/form.vue' /* webpackChunkName: "pages/admin/invitation/form" */).then(m => m.default || m)
const _79196e50 = () => import('../client/pages/index.vue' /* webpackChunkName: "pages/index" */).then(m => m.default || m)
const _2fb81cd4 = () => import('../client/pages/_lang/index.vue' /* webpackChunkName: "pages/_lang/index" */).then(m => m.default || m)
const _32013497 = () => import('../client/pages/_lang/setting/index.vue' /* webpackChunkName: "pages/_lang/setting/index" */).then(m => m.default || m)
const _6f27d25e = () => import('../client/pages/_lang/about.vue' /* webpackChunkName: "pages/_lang/about" */).then(m => m.default || m)
const _328e9e70 = () => import('../client/pages/_lang/invitation/index.vue' /* webpackChunkName: "pages/_lang/invitation/index" */).then(m => m.default || m)
const _a0030aa4 = () => import('../client/pages/_lang/setting/profile.vue' /* webpackChunkName: "pages/_lang/setting/profile" */).then(m => m.default || m)
const _36eb422e = () => import('../client/pages/_lang/auth/login.vue' /* webpackChunkName: "pages/_lang/auth/login" */).then(m => m.default || m)
const _8cc90024 = () => import('../client/pages/_lang/auth/register.vue' /* webpackChunkName: "pages/_lang/auth/register" */).then(m => m.default || m)
const _1811b2f6 = () => import('../client/pages/_lang/invitation/create.vue' /* webpackChunkName: "pages/_lang/invitation/create" */).then(m => m.default || m)



if (process.client) {
  window.history.scrollRestoration = 'manual'
}
const scrollBehavior = function (to, from, savedPosition) {
  // if the returned position is falsy or an empty object,
  // will retain current scroll position.
  let position = false

  // if no children detected
  if (to.matched.length < 2) {
    // scroll to the top of the page
    position = { x: 0, y: 0 }
  } else if (to.matched.some((r) => r.components.default.options.scrollToTop)) {
    // if one of the children has scrollToTop option set to true
    position = { x: 0, y: 0 }
  }

  // savedPosition is only available for popstate navigations (back button)
  if (savedPosition) {
    position = savedPosition
  }

  return new Promise(resolve => {
    // wait for the out transition to complete (if necessary)
    window.$nuxt.$once('triggerScroll', () => {
      // coords will be used if no selector is provided,
      // or if the selector didn't match any element.
      if (to.hash) {
        let hash = to.hash
        // CSS.escape() is not supported with IE and Edge.
        if (typeof window.CSS !== 'undefined' && typeof window.CSS.escape !== 'undefined') {
          hash = '#' + window.CSS.escape(hash.substr(1))
        }
        try {
          if (document.querySelector(hash)) {
            // scroll to anchor by returning the selector
            position = { selector: hash }
          }
        } catch (e) {
          console.warn('Failed to save scroll position. Please add CSS.escape() polyfill (https://github.com/mathiasbynens/CSS.escape).')
        }
      }
      resolve(position)
    })
  })
}


export function createRouter () {
  return new Router({
    mode: 'history',
    base: '/',
    linkActiveClass: 'nuxt-link-active',
    linkExactActiveClass: 'nuxt-link-exact-active',
    scrollBehavior,
    routes: [
		{
			path: "/invitation",
			component: _e1ecc774,
			name: "invitation"
		},
		{
			path: "/about",
			component: _b88923da,
			name: "about"
		},
		{
			path: "/admin",
			component: _b24d20d0,
			name: "admin"
		},
		{
			path: "/setting",
			component: _6ca3ac4e,
			name: "setting"
		},
		{
			path: "/setting/profile",
			component: _10432770,
			name: "setting-profile"
		},
		{
			path: "/admin/login",
			component: _708112af,
			name: "admin-login"
		},
		{
			path: "/admin/dashboard",
			component: _ae525746,
			name: "admin-dashboard"
		},
		{
			path: "/admin/invitation",
			component: _58a884f4,
			name: "admin-invitation"
		},
		{
			path: "/auth/login",
			component: _098bb7a8,
			name: "auth-login"
		},
		{
			path: "/admin/setting",
			component: _42e19099,
			name: "admin-setting"
		},
		{
			path: "/auth/register",
			component: _51487530,
			name: "auth-register"
		},
		{
			path: "/invitation/create",
			component: _79de3738,
			name: "invitation-create"
		},
		{
			path: "/admin/invitation/form",
			component: _2a836280,
			name: "admin-invitation-form"
		},
		{
			path: "/",
			component: _79196e50,
			name: "index"
		},
		{
			path: "/:lang",
			component: _2fb81cd4,
			name: "lang"
		},
		{
			path: "/:lang/setting",
			component: _32013497,
			name: "lang-setting"
		},
		{
			path: "/:lang/about",
			component: _6f27d25e,
			name: "lang-about"
		},
		{
			path: "/:lang/invitation",
			component: _328e9e70,
			name: "lang-invitation"
		},
		{
			path: "/:lang/setting/profile",
			component: _a0030aa4,
			name: "lang-setting-profile"
		},
		{
			path: "/:lang/auth/login",
			component: _36eb422e,
			name: "lang-auth-login"
		},
		{
			path: "/:lang/auth/register",
			component: _8cc90024,
			name: "lang-auth-register"
		},
		{
			path: "/:lang/invitation/create",
			component: _1811b2f6,
			name: "lang-invitation-create"
		}
    ],
    
    
    fallback: false
  })
}
