import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
import Logout from '../components/login/logout'
import Signup from '../components/login/signup'
import Forum from '../components/forum/forum'
import Read from '../components/forum/read'
import Create from '../components/forum/create'
import CreateCategory from '../components/category/CreateCategory'
const routes = [
    { path: '/login', component: Login },
    { path: '/signup', component: Signup },
    { path: '/forum', component: Forum , name:'forum'},
    { path: '/logout', component: Logout},
    { path: '/question/:slug', component: Read, name: 'Read'},
    { path: '/ask', component: Create},
    { path: '/categories', component: CreateCategory},

  ]

  const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang : false,
    mode : 'history',
  })

  export default router