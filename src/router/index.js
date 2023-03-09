import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from '@/store/store';
import { lStore } from '@/controller';

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: '/',
			redirect: '/login'
		},
		{
			path: '/login',
			name: 'login',
			component: () => import('@/views/LoginView.vue')
		},
		{
			path: '/home',
			name: 'home',
			component: () => import('@/views/HomeView.vue')
		},
		{
			path: '/clients',
			name: 'clients',
			component: () => import('@/views/ClientsView/ClientsView.vue'),
			children: [
				{
					path: '/clients',
					name: 'clientslist',
					component: () => import('@/views/ClientsView/ClientsListView.vue'),
				},
				{
					path: '/clients/info',
					name: 'clientsinfo',
					component: () => import('@/views/ClientsView/ClientsInfoView.vue'),
					beforeEnter: () => {
						return new Promise((resolve, reject) => {
							const scroll = setTimeout(() => window.scrollTo(0, 0), 300);
							resolve(scroll);
						});
					}
				}
			]
		},
		{
			path: '/tasks',
			name: 'tasks',
			component: () => import('@/views/TasksView.vue')
		},
		{
			path: '/profile',
			name: 'profile',
			component: () => import('@/views/ProfileView/ProfileView.vue')
		},
		{
			path: '/userprofile',
			name: 'userprofile',
			component: () => import('@/views/ProfileView/UserProfile.vue'),
			beforeEnter: () => {
				if (!lStore.isset('view_profile')) return '/profile';
			}
		},
		{
			path: '/:pathMatch(.*)*',
			name: 'notfound',
			component: () => import('@/views/NotFoundView.vue')
		},
	],
	base: '/nsorchestra/'
});

router.beforeEach((to, from, next) => {
	const userStore = useUserStore();
	userStore.loadUser();
	const isAuthenticated = () => userStore.isLoggedIn;
	if (to.name !== 'login' && !isAuthenticated()) next({ name: 'login' });
	else if (to.name === 'login' && isAuthenticated()) next({ name: 'home' });
	else next();
});

export default router;