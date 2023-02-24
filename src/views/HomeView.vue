<template>
	<Transition class="animate__animated animate__fadeIn">
		<div>
			<HeaderView />
			<SidebarView />
		</div>
	</Transition>
</template>
  
<script>
import HeaderView from '@/components/HeaderView.vue';
import SidebarView from '@/components/SidebarView.vue';
import { showAlert } from '@/controller';

export default {
	components: { HeaderView, SidebarView },
	data() {
		return {
			isShow: false
		};
	},
	mounted() {
		if (this.$router.options.history.state.back == '/login') {
			showAlert('alert-success', 'Login Successful!', 'bi-check-circle-fill');
		}
	}
};
</script>
  
<style scoped></style>