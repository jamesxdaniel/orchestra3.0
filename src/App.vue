<template>
	<div id="alert"></div>
	<div class="container-fluid">
		<RouterView />
	</div>
	<FooterView v-if="this.$route.path != '/login'"/>
</template>

<script>
import FooterView from '@/components/FooterView.vue';
import { RouterView } from 'vue-router';
import { lStore } from '@/controller';
import { useUserStore } from '@/store/store';

export default {
	components: { FooterView },
	setup() {
		const userStore = useUserStore();
		return { userStore };
	},
	created() {
		if (lStore.getObject('user_information') !== null) {
			this.userStore.setUser(lStore.getObject('user_information'));
		}
		if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
			console.log('🎉 Dark mode is supported');
		}
	}
};
</script>

<style scoped></style>