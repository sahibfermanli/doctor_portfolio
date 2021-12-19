import Vue from 'vue'
import Router from 'vue-router'

let Doctor = () => import('./views/Doctor.vue')
let Socials = () => import('./views/Socials.vue')

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
        {
            path: '/admin/doctor/socials/:id',
            name: 'Socials',
            component: Socials,
        },
    ],
})
