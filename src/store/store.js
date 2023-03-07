import { defineStore } from 'pinia';
import { lStore } from '@/controller';

export const useUserStore = defineStore({
    id: 'userStore',
    state: () => ({
        user: null,
        client: null,
        clientList: [],
        currentClientListPage: 1,
        totalClients: null,
        companyName: 'Orchestra',
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
        loadUser() {
            const user = lStore.getObject('user_information');
            if (user) {
                this.user = user;
                this.isLoggedIn = true;
            }
        },
        setClientList(clientList) {
            this.clientList = clientList
        },
        setCurrentClientListPage(page) {
            this.currentClientListPage = page
        },
        setTotalClient(totalClients) {
            this.totalClients = totalClients
        },
        viewClientInfo(client) {
            this.client = client;
        }
    },
});