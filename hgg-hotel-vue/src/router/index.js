
//初始化vue
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

//导入页面组件
import Login from "../views/Login";
import Main from "../views/main/Main";
import List from "../views/main/List";
import CategoryEdit from "../views/main/category/CategoryEdit";
import Changepass from "../views/main/pass/Changepass";
import CategoryAdd from "../views/main/category/CategoryAdd";
import Stayhomeindex from "../views/main/stayhome/Stayhomeindex";
import Stayhomeadd from "../views/main/stayhome/Stayhomeadd";
import Index from "../views/main/category/Index";
import Loading from "../components/loading/Loading";
import Echarts from "../views/main/echarts/Echarts";
const router =new VueRouter({
    routes:[
        {path:'/',component: Main,name:"index",redirect:'/echarts',
            meta:{
                auth:true,title: "首页"
            },
            children:[
                {path:'/changepass',component: Changepass,name:"changepass",meta: {
                        auth: true,title:"修改密码"
                    }
                },
                {path:'/categoryadd',component: CategoryAdd,name:"categoryadd",meta: {
                        auth: true,title:"分类添加"
                    }
                },
                {
                    path: '/index', component: Index, name: "categoryindex", meta: {
                        auth: true, title: "分类查看"
                    }
                },
                {
                    path: '/categoryedit', component: CategoryEdit, name: "categoryedit", meta: {
                        auth: true, title: "分类编辑"
                    }
                },
                {
                    path: '/stayhomeadd', component: Stayhomeadd, name: "stayhomeadd", meta: {
                        auth: true, title: "民宿添加"
                    }
                },
                {
                    path: '/stayhomeindex', component: Stayhomeindex, name: "stayhomeindex", meta: {
                        title: "民宿查看",auth: true
                    }
                },
                {
                    path: '/loading', component: Loading, name: "loading", meta: {
                        title: "loading",auth: true
                    }
                },
                {
                    path: '/echarts', component: Echarts, name: "echarts", meta: {
                        title: "echarts",auth: true
                    }
                },
            ]
        },
        {path:'/login',component: Login,name:"login",meta: {
                auth: false,title: "登录"
            }},
        {path:'/list',component: List,name:"list",meta: {
                auth: true,title: "列表"
            }}
    ]
})

/**
 *
 * 导航守卫
 * 1.监听路由变化，前置守卫
 * 2.to 路由元信息
 **/

//路由守卫 beforeeach
router.beforeEach((to,from,next)=>{
    let title=to.meta.title||'首页';
    document.title=title;
    to,from;
    if(to.meta.auth){
        let token=sessionStorage.getItem('token');//获取到本地的token所对应的值
        token=token&&token.trim();//判断是否相等trim去空
        if(token){
            next();
        }else{
            next({path:'login',query:{redirect:to.name}})
        }
    }else{
        next();
    }
    next();
});

export default router;