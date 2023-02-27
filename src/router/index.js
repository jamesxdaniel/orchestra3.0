import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from '@/store';

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
      path: '/profile',
      name: 'profile',
      component: () => import('@/views/ProfileView.vue')
    },
    {
      path: '/userprofile',
      name: 'userprofile',
      component: () => import('@/views/UserProfile.vue')
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