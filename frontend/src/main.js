import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import './index.css'
import router from './router'

const http = axios.create({
    baseURL: process.env.VUE_APP_BASE_URL
})
http.defaults.withCredentials = true;

const app = createApp(App)
app.config.globalProperties.$axios = http;
app.use(router)
app.mount('#app')

