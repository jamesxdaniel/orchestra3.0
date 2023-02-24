<template>
  <div class="container-fluid">
    <RouterView />
  </div>
</template>

<script>
import { RouterView } from 'vue-router';
import { lStore } from '@/controller';
import { useUserStore } from '@/store.js';

export default {
  data() {
    return {
      mode: null
    }
  },
  setup() {
    if (lStore.getObject('user_information') !== null) {
      const userStore = useUserStore();
      userStore.setUser(lStore.getObject('user_information'));
    }
  },
  created() {
    if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
      console.log('🎉 Dark mode is supported');
    }
  }
}
</script>

<style scoped>

</style>
