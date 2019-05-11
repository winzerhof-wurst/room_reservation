<template>
	<Content app-name="room_reservation">
		<Navigation></Navigation>
		<AppContent>
			<h2>{{ t('room_reservation', 'Requests') }}</h2>
			<ul>
				<li v-for="reservation in reservations" :key="reservation.id">
					{{ reservation.id }}
				</li>
			</ul>
		</AppContent>
	</Content>
</template>

<script>
	import AppContent from 'nextcloud-vue/dist/Components/AppContent'
	import Content from 'nextcloud-vue/dist/Components/Content'

	import Navigation from '../components/Navigation'

	export default {
		name: "Requests",
		components: {
			AppContent,
			Content,
			Navigation,
		},
		computed: {
			reservations () {
				return this.$store.getters.getRequests()
			}
		}
	}
</script>

<style scoped>

</style>
