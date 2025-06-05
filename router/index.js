import { createRouter, createWebHistory } from 'vue-router';
import News from '../resources/js/Pages/User/News.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/news',
            name: 'News',
            component: () => import('../resources/js/Pages/User/News')
        }
    ]
});

// router.beforeResolve((to, from) => {
//     console.log('Noticia Authenticated')
//     console.log('Coming from:', from.path)
//     console.log('Going to:', to.path)
// })

export default router;
