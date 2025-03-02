import { createApp } from 'vue'
import App from '../../views/App.vue'
import router from '../../router/index'
import store from '../../store';

const app = createApp(App)
app.use(store);
app.use(router)
app.mount("#app")