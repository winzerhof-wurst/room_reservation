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
				<RequestDetails v-if="detailRequest"
								:request="detailRequest">
				</RequestDetails>
			</div>
		</AppContent>
	</Content>
</template>

<script>
	import AppContent from 'nextcloud-vue/dist/Components/AppContent'
	import Content from 'nextcloud-vue/dist/Components/Content'

	import Navigation from '../components/Navigation'
	import Request from '../components/Request'
	import RequestDetails from '../components/RequestDetails'

	export default {
		name: "Requests",
		components: {
			AppContent,
			Content,
			Navigation,
			Request,
			RequestDetails,
		},
		computed: {
			requests () {
				return this.$store.getters.getRequests()
			},
			detailRequest () {
				if (this.$route.params.id) {
					return this.$store.getters.getRequest(this.$route.params.id)
				}
			}
		}
	}
</script>

<style scoped>

</style>
