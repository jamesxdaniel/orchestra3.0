import { defineStore } from 'pinia';
import { lStore } from '@/controller';

export const useUserStore = defineStore({
    id: 'userStore',
    state: () => ({
        user: null,
        isLoggedIn: false,
        isSidebarClicked: false
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
        loadUser() {
            const user = lStore.getObject('user_information');
            if (user) {
                this.user = user;
                this.isLoggedIn = true;
            }
        },
        sidebarClick() {
            this.isSidebarClicked = true;
        }
    },
});