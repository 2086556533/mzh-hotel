import Vue from 'vue'
import App from './App.vue'
import router from "./router";
import 'u-reset.css';
import vcosole from 'vconsole';
import MuseUI from 'muse-ui';
import 'muse-ui/dist/muse-ui.css'
import store from "./store";
// import store from "./router";
import Vant from 'vant'
Vue.use(MuseUI);
Vue.use(Vant);
new vcosole();
Vue.config.productionTip = false;

new Vue({
  store,
  router,
  render: h => h(App),
}).$mount('#app')
//移动端调错工具
