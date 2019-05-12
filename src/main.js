import {generateFilePath} from 'nextcloud-server/dist/router'
import {sync} from 'vuex-router-sync'
import {translate, translatePlural} from 'nextcloud-server/dist/l10n'
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
		n: translatePlural,
	},
})

const rooms = OCP.InitialState.loadState(
	'room_reservation',
	'rooms',
)
const requests = OCP.InitialState.loadState(
	'room_reservation',
	'requests',
)

store.commit('setRooms', {rooms})
store.commit('setRequests', {requests})

new Vue({
	el: '#content',
	router,
	store,
	render: h => h(App),
})
