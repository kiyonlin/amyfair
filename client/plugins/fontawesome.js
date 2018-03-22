import Vue from 'vue'
import fontawesome from '@fortawesome/fontawesome'
import FontAwesomeIcon from '@fortawesome/vue-fontawesome'

// import regular from '@fortawesome/fontawesome-free-regular/shakable.es'

import {
    faUser,
    faUserCircle,
    faLock,
    faSignOutAlt,
    faCog,
    faBell,
    faPlus,
    faSearch,
    faSync,
    faTrash
} from '@fortawesome/fontawesome-free-solid/shakable.es'

import { faGithub } from '@fortawesome/fontawesome-free-brands/shakable.es'

fontawesome.config.autoAddCss = false

fontawesome.library.add(
    faUser, faUserCircle, faLock,
    faSignOutAlt, faCog, faBell,
    faPlus, faSearch, faSync, faTrash,
    faGithub,
)

Vue.component('fa', FontAwesomeIcon)
