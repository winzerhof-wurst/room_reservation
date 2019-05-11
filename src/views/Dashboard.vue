<template>
	<Content app-name="room_reservation">
		<Navigation></Navigation>
		<AppContent>
			<h2>{{ t('room_reservation', 'Reservation Dashboard') }}</h2>
		</AppContent>
	</Content>
</template>

<script>
	import AppContent from 'nextcloud-vue/dist/Components/AppContent'
	import Content from 'nextcloud-vue/dist/Components/Content'

	import Navigation from '../components/Navigation'

	export default {
		name: "Dashboard",
		components: {
			AppContent,
			Content,
			Navigation,
		}
	}
</script>

<style scoped>

</style>
