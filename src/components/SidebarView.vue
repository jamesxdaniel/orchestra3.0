<template>
    <aside id="sidebar" class="sidebar" v-if="this.$userStore.isLoggedIn">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <router-link to="/home" class="nav-link" @click="sidebarClick">
                    <i class="ri-home-3-line"></i>
                    <span>Home</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/clients" class="nav-link" @click="sidebarClick">
                    <i class="ri-briefcase-line"></i>
                    <span>Clients</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/tasks" class="nav-link" @click="sidebarClick">
                    <i class="ri-pages-line"></i>
                    <span>Tasks</span>
                </router-link>
            </li>

        </ul>
    </aside>
</template>

<script>
export default {
    methods: {
        sidebarClick() {
            if (window.innerWidth <= 768) {
                document.body.classList.toggle('toggle-sidebar');
            }
        }
    }
};
</script>

<style scoped></style>