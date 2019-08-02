import VueRouter from 'vue-router'
// Pages
import Home from './components/Home'
//import About from './components/About'
import Register from './components/Register'
import Login from './components/Login'
import Dashboard from './components/Dashboard'
import myfavs from './components/myfavs'
//import AdminDashboard from './components/admin/Dashboard'
// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: false
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    // USER ROUTES
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: '/my-favs',
        name: 'myfavs',
        component: myfavs,
        meta: {
            auth: true
        }
    },
    /*{
        path: '/detail',
        name: 'detail',
        component: 'detail',
        meta: {
            auth: true
        }
    }*/

];
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});
export default router
