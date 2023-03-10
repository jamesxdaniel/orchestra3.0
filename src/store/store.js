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
        searchedClient: null,
        currentSearchedClientListPage: 1,
        totalClientsSearched: null,
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
            this.clientList = clientList;
        },
        setTotalClient(totalClients) {
            this.totalClients = totalClients;
        },
        setTotalClientSearch(totalClients) {
            this.totalClientsSearched = totalClients;
        },
        setSearchedClient(client) {
            this.searchedClient = client;
        },
        viewClientInfo(client) {
            this.client = client;
        }
    },
});