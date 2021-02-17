import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/changePassword',
    name: 'ChangePassword',
    component: () => import('../views/ChangePassword.vue')
  },
  {
    path: '/tveMaker',
    name: 'TveMaker',
    component: () => import('../views/TveMaker.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
