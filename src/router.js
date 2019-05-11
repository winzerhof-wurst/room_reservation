import Vue from 'vue'
import Router from 'vue-router'
import {generateUrl} from 'nextcloud-server/dist/router'

const Calendar = () => import('./views/Calendar')
const Dashboard = () => import('./views/Dashboard')
const NewReservation = () => import('./views/NewReservation')
const Requests = () => import('./views/Requests')

Vue.use(Router)

export default new Router({
	base: generateUrl('/apps/mail/'),
	linkActiveClass: 'active',
	routes: [
		{
			path: '/',
			name: 'dashboard',
			component: Dashboard,
		},
		{
			path: '/calendar',
			name: 'calendar',
			component: Calendar,
		},
		{
			path: '/new',
			name: 'new',
			component: NewReservation,
		},
		{
			path: '/requests',
			name: 'requests',
			component: Requests,
		},
	],
})
