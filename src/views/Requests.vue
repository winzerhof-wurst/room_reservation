<template>
	<Content app-name="room_reservation">
		<Navigation></Navigation>
	</Content>
</template>

<script>
	import Content from 'nextcloud-vue/dist/Components/Content'

	import Navigation from '../components/Navigation'

	export default {
		name: "Requests",
		components: {
			Content,
			Navigation,
		}
	}
</script>

<style scoped>

</style>
