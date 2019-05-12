import Vue from 'vue'
import Vuex from 'vuex'

import actions from './actions'
import mutations from './mutations'

Vue.use(Vuex)

export const getters = {
	getRequests: state => () => {
		return state.requestList.map(id => state.requests[id])
	},
	getRequest: state => id => {
		return state.requests[id]
	},
	getRoom: state => id => {
		return state.rooms[id]
	},
}

export default new Vuex.Store({
	strict: process.env.NODE_ENV !== 'production',
	state: {
		rooms: {},
		requests: {},
		requestList: [],
	},
	getters,
	mutations,
	actions,
})
