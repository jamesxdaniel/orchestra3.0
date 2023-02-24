import { useUserStore } from './store';

export const useUserPlugin = {
  install: (app) => {
    const userStore = useUserStore();
    app.config.globalProperties.$userStore = userStore.$state;
  },
};