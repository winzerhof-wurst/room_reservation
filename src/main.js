import {generateFilePath} from 'nextcloud-server/dist/router'
import {sync} from 'vuex-router-sync'
import {translate} from 'nextcloud-server/dist/l10n'
import Vue from 'vue'

import App from './App'
import router from './router'
import store from './store'

__webpack_nonce__ = btoa(OC.requestToken)
__webpack_public_path__ = generateFilePath('room_reservation', '', 'js/')

sync(store, router)

Vue.mixin({
	methods: {
		t: translate,
	},
})

new Vue({
	el: '#content',
	router,
	store,
	render: h => h(App),
})
