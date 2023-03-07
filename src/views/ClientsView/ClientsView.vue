<template>
	<HeaderView />
	<SidebarView />
	<RouterView />
</template>
  
<script>

import HeaderView from '@/components/HeaderView.vue';
import SidebarView from '@/components/SidebarView.vue';

export default {
	components: { HeaderView, SidebarView },
};
</script>
  
<style scoped></style>