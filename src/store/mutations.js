import Vue from 'vue'

export default {
	setRooms (state, {rooms}) {
		Vue.set(state, 'rooms', {})

		rooms.forEach(room => Vue.set(state.rooms, room.id, room))
	},
	setRequests (state, {requests}) {
		Vue.set(state, 'requests', {})

		requests.forEach(request => Vue.set(state.requests, request.id, request))

		// TODO: sort
		Vue.set(state, 'requestList', requests.map(r => r.id))
	},
}
