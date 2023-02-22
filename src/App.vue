<template>
  <div class="container-fluid d-flex">
    <RouterView />
  </div>
</template>

<script>
import { RouterView } from 'vue-router';

export default {
  data() {
    return {
      mode: 'light'
    }
  },
  created() {
    document.querySelector('body').classList.add('light');
  }
}
</script>

<style scoped>

</style>
