<template>
	<a href="#"
	   class="app-content-list-item"
	   @click.prevent="click">
		<div class="app-content-list-item-icon"
			 style="background-color: rgb(231, 192, 116);">{{ nrOfDays }}
		</div>
		<div class="app-content-list-item-line-one">
			{{ request.firstname }}&nbsp;{{ request.lastname }}
		</div>
		<div class="app-content-list-item-line-two">
			<b>{{ n('room_reservation', '%n room', '%n rooms',
				request.nrOfRooms) }}</b>
			<b>{{ n('room_reservation', '%n person', '%n people',
				request.nrOfPeople) }}</b>
			{{ localeDate(request.startDate) }}-{{ localeDate(request.endDate)
			}}
		</div>
	</a>
</template>

<script>
	export default {
		name: "Request",
		props: {
			request: {
				type: Object,
				required: true,
			}
		},
		computed: {
			nrOfDays () {
				const start = new Date(this.request.startDate)
				const end = new Date(this.request.endDate)
				console.info(end - start)
				return Math.floor((end - start) / (60 * 60 * 24 * 1000))
			}
		},
		methods: {
			click () {
				console.info('show', this.request)
			},
			localeDate (dateString) {
				const d = new Date(dateString)
				return d.toLocaleDateString()
			}
		}
	}
</script>

<style scoped>

</style>
