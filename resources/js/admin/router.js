import Vue from 'vue'
import Router from 'vue-router'

let Admin = () => import('./views/Admin.vue')
let Doctor = () => import('./views/Doctor.vue')
let Socials = () => import('./views/Socials.vue')
let Education = () => import('./views/Education.vue')
let Skills = () => import('./views/Skills.vue')
let Category = () => import('./views/Category.vue')
let Blogs = () => import('./views/Blogs.vue')

Vue.use(Router)

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/admin/users',
            name: 'Admin',
            component: Admin,
        },
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
        {
            path: '/admin/doctor/education/:id',
            name: 'Education',
            component: Education,
        },
        {
            path: '/admin/doctor/skills/:id',
            name: 'Skills',
            component: Skills,
        },
        {
            path: '/admin/categories',
            name: 'Category',
            component: Category,
        },
        {
            path: '/admin/blogs',
            name: 'Blogs',
            component: Blogs,
        },
    ],
})
