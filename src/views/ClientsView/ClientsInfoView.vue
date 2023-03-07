<template>
	<Transition class="animate__animated animate__fadeIn">
		<main class="main" v-if="this.$userStore.isLoggedIn && this.$userStore.client !== null">

			<div class="pagetitle">
				<h1>{{ this.$userStore.client.company }}</h1>
			</div>

		</main>
	</Transition>
</template>
  
<script>
export default {
	created() {
		if (this.$userStore.client == null) this.$router.go(-1);
	}
};
</script>

<style scoped></style>