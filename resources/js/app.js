import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// import AOS from 'aos';
// import 'aos/dist/aos.css';
// AOS.init();
// Efecto parallax (opcional)
//import Parallax from 'parallax-js';

// Efecto tilt en tarjetas
// import VanillaTilt from 'tilt.js';
// VanillaTilt.init(document.querySelectorAll("[data-tilt]"), {
//   max: 15,
//   speed: 400,
//   glare: true,
//   "max-glare": 0.2,
// });

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css'
// import VueRouter from 'vue-router'
// app.use(VueRouter)



//swal alart
import VueSweetalert2 from 'vue-sweetalert2';
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            app.use(plugin)
            app.use(ZiggyVue)
            app.use(ElementPlus)
            app.use(VueSweetalert2)
             window.Swal =  app.config.globalProperties.$swal
            app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
