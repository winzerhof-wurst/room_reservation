<template>
	<div class="app-content-detail">
		<h2>{{ t('room_reservation', 'Request #{id}', {id: request.id}) }}</h2>
		<p>
			{{ t('room_reservation', '{days} days ({start} to {end}) for {persons} persons.', {
				days: nrOfDays,
				start: localeDate(request.startDate),
				end: localeDate(request.endDate),
				persons: request.nrOfPeople
			}) }}
		</p>
		<p>
			<h3>{{ t('room_reservation', 'Preferred rooms') }}</h3>
			<ul v-if="rooms.length > 0">
				<li v-for="room in rooms">
					{{ room.name }}
				</li>
			</ul>
			<span v-else>{{ t('room_reservation', 'No preferred rooms selected') }}</span>
		</p>
	</div>
</template>

<script>
	export default {
		name: "RequestDetails",
		props: {
			request: {
				type: Object,
				required: true,
			},
		},
		computed: {
			nrOfDays () {
				const start = new Date(this.request.startDate)
				const end = new Date(this.request.endDate)
				return Math.floor((end - start) / (60 * 60 * 24 * 1000))
			},
			rooms() {
				if (this.request.rooms === null) {
					return []
				}
				console.info(this.request.rooms)
				console.info(this.request.rooms.map(id => this.$store.getters.getRoom(id)))
				return this.request.rooms.map(id => this.$store.getters.getRoom(id))
			},
		},
		methods: {
			localeDate (dateString) {
				console.info(this.request)
				const d = new Date(dateString)
				return d.toLocaleDateString()
			}
		}
	}
</script>

<style scoped>
	.app-content-detail {
		padding: 10px;
	}
</style>
