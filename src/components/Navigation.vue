<template>
	<AppNavigation>
		<AppNavigationNew
				:text="t('room_reservation', 'New reservation')"
				@click="click">
		</AppNavigationNew>
		<ul id="usergrouplist">
			<AppNavigationItem :item="dashboard"></AppNavigationItem>
			<AppNavigationItem :item="requests"></AppNavigationItem>
			<AppNavigationItem :item="calendar"></AppNavigationItem>
		</ul>
	</AppNavigation>
</template>

<script>
	import AppNavigation from 'nextcloud-vue/dist/Components/AppNavigation'
	import AppNavigationItem
		from 'nextcloud-vue/dist/Components/AppNavigationItem'
	import AppNavigationNew
		from 'nextcloud-vue/dist/Components/AppNavigationNew'

	export default {
		name: "Navigation",
		components: {
			AppNavigation,
			AppNavigationItem,
			AppNavigationNew,
		},
		data () {
			return {
				calendar: {
					id: 'nav-calendar',
					key: 'nav-calendar',
					text: t('room_reservation', 'Calendar'),
					icon: 'icon-info',
					router: {
						name: 'calendar',
					},
				},
				dashboard: {
					id: 'nav-dashboard',
					key: 'nav-dashboard',
					text: t('room_reservation', 'Dashboard'),
					icon: 'icon-info',
					router: {
						name: 'dashboard',
					},
				},
				requests: {
					id: 'nav-requests',
					key: 'nav-requests',
					text: t('room_reservation', 'Requests'),
					icon: 'icon-info',
					router: {
						name: 'requests',
						exact: false,
					},
				}
			}
		},
		methods: {
			click () {
				this.$router.push({name: 'new'})
			}
		}
	}
</script>

<style scoped>

</style>
