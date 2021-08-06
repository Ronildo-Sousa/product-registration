import {
  createRouter,
  createWebHashHistory
} from 'vue-router'
import Home from '../views/public/Home'

const routes = [{
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/admin',
    name: 'AdminForm',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import( /* webpackChunkName: "about" */ '../views/public/AdminForm.vue'),
    beforeEnter: (to, from, next) => {
      let loggedIn = localStorage.getItem('user-token')
      if (loggedIn) next({
        name: 'Dashboard'
      })
      else next()
    }
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import( /* webpackChunkName: "about" */ '../views/admin/Dashboard.vue'),
    beforeEnter: (to, from, next) => {
      let loggedIn = localStorage.getItem('user-token')
      if (!loggedIn) next({
        name: 'AdminForm'
      })
      else next()
    }
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router