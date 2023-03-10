<template>
    <header id="header" class="header fixed-top d-flex align-items-center bg-gradient" v-if="this.$userStore.isLoggedIn">
        <div class="d-flex align-items-center justify-content-between">
            <router-link to="/home" class="logo d-flex align-items-center">
                <span class="logo fw-bolder d-none d-lg-block">{{ this.$userStore.companyName }} <span class="text-secondary">3.0</span></span>
            </router-link>
            <i class="bi bi-list toggle-sidebar-btn" @click="toggleSidebar"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item mode-button dropdown pe-3 m-0 d-none">
                    <button type="button" id="darkMode" class="btn btn-dark btn-sm rounded-circle d-flex align-item-center"><i class="ri-moon-fill"></i></button>
                    <button type="button" id="lightMode" class="btn btn-warning btn-sm rounded-circle d-flex align-item-center d-none"><i class="ri-sun-line"></i></button>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" @click="toggleDropdown">
                        <img :src="`https://office.orchestra.tools/` + this.$userStore.user.user_photo" alt="Profile" class="rounded-circle" v-if="this.$userStore.user.user_photo.includes('assets/profile')">
                        <img :src="`http://ns.proweaver.host/nsorchestra/api/` + this.$userStore.user.user_photo" alt="Profile" class="rounded-circle" v-else>
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ this.$userStore.user.user_alias_name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" :class="{ 'show': isShowDropdown }">
                        <li class="dropdown-header">
                            <h6>{{ this.$userStore.user.user_alias_name }}</h6>
                            <span>{{ this.$userStore.user.team_name }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <router-link class="dropdown-item d-flex align-items-center" to="/profile" @click="toggleDropdown">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </router-link>
                        </li>
                        <li>
                            <a href="javascript:;" class="dropdown-item d-flex align-items-center" @click="logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
import { useUserStore } from '@/store/store';
import { delay, showToast } from '@/controller';

export default {
    data() {
        return {
            isShowDropdown: false
        };
    },
	setup() {
		const userStore = useUserStore();
		return { userStore };
	},
    mounted() {
        // this.themeSet();
        // console.log(this.$userStore.user);
    },
    methods: {
        toggleSidebar() {
            document.body.classList.toggle('toggle-sidebar');
        },
        toggleDropdown() {
            this.isShowDropdown = !this.isShowDropdown;
        },
        themeSet() {
            const darkMode = document.getElementById('darkMode');
            const lightMode = document.getElementById('lightMode');
            const body = document.body;

            darkMode.addEventListener('click', () => {
                body.classList.add('dark');
                body.classList.remove('light'); 
                darkMode.classList.add('d-none');
                lightMode.classList.remove('d-none');
                localStorage.setItem('theme', 'dark');
            });

            lightMode.addEventListener('click', () => {
                body.classList.add('light');
                body.classList.remove('dark');
                lightMode.classList.add('d-none');
                darkMode.classList.remove('d-none');
                localStorage.setItem('theme', 'light');
            });

            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                body.classList.add('light');
                localStorage.setItem('theme', 'light');
            }

            darkMode.classList.toggle('d-none', localStorage.getItem('theme') === 'dark');
            lightMode.classList.toggle('d-none', localStorage.getItem('theme') === 'light');
        },
        logout() {
            delay(0)
            .then(() => {
                delay(0)
                    .then(() => showToast('You have successfully logged out', 'alert-success'))
                    .then(() => this.$router.push('/login'));
            })
            .then(() => {
                this.userStore.clearUser();
                localStorage.removeItem('user_information');
                localStorage.removeItem('view_profile');
            });
        }
    }
};
</script>

<style scoped>
.logo {
    text-shadow: 2px 2px 2px rgba(0,0,0,0.3);
}
.show {
    position: absolute;
    inset: 0px 0px auto auto;
    margin: 0px;
    transform: translate(-16px, 38px);
}

.mode-button button {
    width: 32px;
    height: 32px;
}
</style>