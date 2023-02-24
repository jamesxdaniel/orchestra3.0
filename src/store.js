import { defineStore } from 'pinia';

export const useUserStore = defineStore({
    id: 'userStore',
    state: () => ({
        user: null,
        isLoggedIn: false,
    }),
    actions: {
        setUser(user) {
            this.user = user;
            this.isLoggedIn = true;
        },
        clearUser() {
            this.user = null;
            this.isLoggedIn = false;
        },
    },
});