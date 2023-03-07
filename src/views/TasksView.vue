<template>
	<HeaderView />
	<SidebarView />
	<Transition class="animate__animated animate__fadeIn">
		<main id="main" class="main" v-if="this.$userStore.isLoggedIn">

			<div class="pagetitle">
				<h1>Tasks</h1>
			</div>

		</main>
	</Transition>
</template>
  
<script>
import HeaderView from '@/components/HeaderView.vue';
import SidebarView from '@/components/SidebarView.vue';

export default {
	components: { HeaderView, SidebarView },
	data() {
		return {};
	}
};
</script>
  
<style scoped></style>