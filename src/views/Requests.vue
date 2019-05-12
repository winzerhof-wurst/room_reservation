<template>
	<Content app-name="room_reservation">
		<Navigation></Navigation>
		<AppContent>
			<div id="app-content-wrapper">
				<div class="app-content-list">
					<Request v-for="request in requests"
							 :key="request.id"
							 :request="request">
					</Request>
				</div>
				<div class="app-content-detail">
					todo
				</div>
			</div>
		</AppContent>
	</Content>
</template>

<script>
	import AppContent from 'nextcloud-vue/dist/Components/AppContent'
	import Content from 'nextcloud-vue/dist/Components/Content'

	import Navigation from '../components/Navigation'
	import Request from '../components/Request'

	export default {
		name: "Requests",
		components: {
			AppContent,
			Content,
			Navigation,
			Request,
		},
		computed: {
			requests () {
				return this.$store.getters.getRequests()
			}
		}
	}
</script>

<style scoped>

</style>
