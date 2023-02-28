<template>
	<HeaderView />
	<Transition class="animate__animated animate__fadeIn">
        <div>
            <SidebarView />
			<main id="main" class="main" v-if="this.$userStore.isLoggedIn"></main>
		</div>
	</Transition>
</template>
  
<script>
import HeaderView from '@/components/HeaderView.vue';
import SidebarView from '@/components/SidebarView.vue';

export default {
	components: { HeaderView, SidebarView },
	data() {
		return {
			isShow: false
		};
	},
	mounted() {
		// if (this.$router.options.history.state.back == '/login')
	}
};
</script>
  
<style scoped></style>