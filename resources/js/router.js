import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

import firstPage from './components/pages/myFirstVuePage.vue';
import newroutePage from './components/pages/newroutePage.vue';
import hooks from './components/pages/basic/hooks.vue';
import method from './components/pages/basic/method.vue';

const routes = [
    {
        path: '/my-new-vue-route',
        component: firstPage
    },
    {
        path: '/new-route',
        component: newroutePage
    },

    //vue hooks
    {
        path: '/hooks',
        component: hooks
    },
    {
        path: '/method',
        component: method
    }
]

export default new Router({
    mode: 'history',
    routes
});