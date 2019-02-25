import Vue from 'vue'
import Router from 'vue-router';

Vue.use(Router)
export default function router(routes) {
    const router = new Router({
        routes,
        scrollBehavior,
        mode:'history'
    });
    router.beforeEach((to, from, next) => {
        const components = router.getMatchedComponents(to);
        if (components.length) {
            setTimeout(() =>{
                router.app.setLayout(components[components.length-1].layout || '');
            },0);
        }
        next();
    });
    return router;
}

function scrollBehavior(to, from, savedPosition){
    if (savedPosition) {
        return savedPosition;
    }
    const position = {}
    if (to.hash) {
        position.selector = to.hash;
    }
    if (to.matched.some(m=>m.meta.scrollToTop)) {
        position.x = 0;
        position.y = 0;
    }
    return position;
}