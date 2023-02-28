<template>
    <aside id="sidebar" class="sidebar" v-if="this.$userStore.isLoggedIn">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <router-link to="/home" class="nav-link">
                    <i class="ri-home-3-line"></i>
                    <span>Home</span>
                </router-link>
            </li>

        </ul>
    </aside>
</template>

<script>

</script>

<style scoped></style>