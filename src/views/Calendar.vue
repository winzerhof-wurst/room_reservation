<template>
	<Content app-name="room_reservation">
		<Navigation></Navigation>
		<AppContent>
			<FullCalendar :config="config" :events="events"></FullCalendar>
		</AppContent>
	</Content>
</template>

<script>
	import AppContent from 'nextcloud-vue/dist/Components/AppContent'
	import Content from 'nextcloud-vue/dist/Components/Content'
	import 'fullcalendar/dist/fullcalendar.css'
	import {FullCalendar} from 'vue-full-calendar'

	import Navigation from '../components/Navigation'

	export default {
		name: "Calendar",
		components: {
			AppContent,
			Content,
			FullCalendar,
			Navigation,
		},
		computed: {
			config () {
				return {
					defaultView: 'month',
					editable: false,
					header: false,
					selectable: false,
					weekends: false,
				}
			},
			events () {
				return [
					{
						title: 'Test',
						start: '2019-05-11',
						end: '2019-05-17',
					}
				]
			},
		}
	}
</script>

<style scoped>

</style>
