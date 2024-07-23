import 'bootstrap';
import './assets/main.css';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import VueLazyLoad from 'vue3-lazyload';

import App from './App.vue'
import router from './router'

import axios from "./services/axios";
import iziToast from "izitoast";
import registerDirectives from './directives/registerDirectives';

(window as any).axios = axios;
(window as any).iziToast = iziToast;

let app = createApp(App)
    .use(createPinia())
    .use(router)
    .use(VueLazyLoad, {
        loading: '/assets/images/spinner.gif',
        error: '/assets/images/erro.png',
        delay: 100
    });

app = registerDirectives(app)
app.mount('#app');