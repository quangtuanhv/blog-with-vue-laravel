require('./bootstrap');
window.Vue = require('vue');
import Master from './components/Master'
import routers from './router/index'
import makeRouter from './router/middleware'
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar);
const router = makeRouter(routers);
const app = new Vue({
    el: '#app',
    router,
    ...Master
});
