import { createRouter, createWebHistory } from "vue-router";

import home from '../../views/home.vue';
import about from '../components/about.vue';
import notFound from '../components/notFound.vue'
import quizesView from '../../views/quizePage.vue'


const routes = [

    {
        path:'/',
        component:home
    },
    {
        path:'/about',
        component:about
    },
    ,
       {path:"/quizes/:id",
   
        name:'quizes',
    
        component:quizesView
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