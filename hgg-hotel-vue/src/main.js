import Vue from 'vue'
import App from './App.vue'
import router from "./router";
import "u-reset.css";
import axios from 'axios';
import filter from "./filter";
import 'element-ui/lib/theme-chalk/index.css'
import ElementUI from 'element-ui';

Vue.use(ElementUI);
Vue.config.productionTip = false;
Vue.prototype.$http = axios;
//全局过滤器
//每次添加一个过滤器  以下的代码都会将其注册成为新的全局过滤器
Object.keys(filter).forEach(ele=>{
  Vue.filter(ele,filter[ele])
})
new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
