import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import '@/assets/main.css';
import '@/assets/vendor/bootstrap/css/bootstrap.min.css';
import '@/assets/vendor/bootstrap-icons/bootstrap-icons.css';
import '@/assets/vendor/boxicons/css/boxicons.min.css';
import '@/assets/vendor/quill/quill.snow.css';
import '@/assets/vendor/quill/quill.bubble.css';
import '@/assets/vendor/remixicon/remixicon.css';
import '@/assets/vendor/simple-datatables/style.css';
import '@/assets/css/style.css';

const app = createApp(App);

app.use(router);

router.isReady().then(() => {
    app.mount('#app');
});