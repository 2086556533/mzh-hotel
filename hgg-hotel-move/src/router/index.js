//初始化vue路由
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Store from "../store";

const routes = [
    {
        //将默认页面设置为home页面
        path: '/',
        name: 'Index',
        component: () => import('../views/index/Index')
    },
    {
        //引入省份组件
        path: '/province',
        name: 'Province',
        component: () => import('../views/province/Province')
    },
    {
        //引入about组件
        path: '/about',
        name: 'About',
        component: () => import('../views/About')
    },
    {
        //引入home组件
        path: '/home',
        name: 'Home',
        component: () => import('../views/Home')
    },

];

const router = new VueRouter({
    routes,
    Store
});

export default router;
