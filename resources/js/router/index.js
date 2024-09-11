import { createRouter, createWebHistory } from "vue-router";

import home from '../../views/home.vue';
import about from '../components/about.vue';
import notFound from '../components/notFound.vue'

const routes = [

    {
        path:'/',
        component:home
    },
    {
        path:'/about',
        component:about
    },
    {
        path:'/:pathMatch(.*)*',
        component:notFound
    }


]

const router = createRouter({
    history:createWebHistory(),
    routes,
})

export default router