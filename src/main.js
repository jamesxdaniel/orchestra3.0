import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { useUserPlugin } from '@/storePlugin';
import App from './App.vue';
import router from './router';

// NiceAdmin Dependencies CSS
import '@/assets/base.css';
import '@/assets/vendor/bootstrap/css/bootstrap.min.css';
import '@/assets/vendor/bootstrap-icons/bootstrap-icons.css';
import '@/assets/vendor/boxicons/css/boxicons.min.css';
import '@/assets/vendor/quill/quill.snow.css';
import '@/assets/vendor/quill/quill.bubble.css';
import '@/assets/vendor/remixicon/remixicon.css';
import '@/assets/vendor/simple-datatables/style.css';
import '@/assets/css/style.css';

// NiceAdmin Dependencies JS
import '@/assets/vendor/apexcharts/apexcharts.min.js';
import '@/assets/vendor/bootstrap/js/bootstrap.bundle.min.js';
import '@/assets/vendor/chart.js/chart.umd.js';
import '@/assets/vendor/echarts/echarts.min.js';
import '@/assets/vendor/quill/quill.min.js';
import '@/assets/vendor/simple-datatables/simple-datatables.js';
import '@/assets/vendor/tinymce/tinymce.min.js';
import '@/assets/vendor/php-email-form/validate.js';
import '@/assets/js/main.js';

// Remix Icons
import 'remixicon/fonts/remixicon.css';

// Animate.css
import 'animate.css';

const pinia = createPinia();

const app = createApp(App).use(router).use(pinia).use(useUserPlugin);

router.isReady().then(() => {
    app.mount('#app');
});