import Vue from 'vue'
import Router from 'vue-router'

let Doctor = () => import('./views/Doctor.vue')

Vue.use(Router)

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/admin/doctor',
            name: 'Doctor',
            component: Doctor,
        },
    ],
})
