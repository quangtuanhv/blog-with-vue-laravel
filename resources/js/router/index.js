import vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../components/home/Home';
vue.use(VueRouter);
const router = [
    {path:'/',component: Home, name: 'home_page'}
]

export default router;