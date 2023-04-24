import { createApp } from 'vue'
import App from './App.vue'

import BootstrapVueNext from 'bootstrap-vue-next'
import axios from 'axios'
import VueAxios from 'vue-axios'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'

createApp(App).use(BootstrapVueNext).use(VueAxios, axios).mount('#app')
