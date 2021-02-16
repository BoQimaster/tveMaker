import { createApp } from 'vue'
import ELementPlus from 'element-plus'
import 'element-plus/lib/theme-chalk/index.css'
import App from './App.vue'
import router from './router'
import store from './store'

createApp(App).use(store)
              .use(router)
              .use(ELementPlus)
              .mount('#app')
