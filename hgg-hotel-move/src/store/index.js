import Vue from "vue";
import Vuex from 'vuex'
// import {context} from "vant/lib/mixins/popup/context";
Vue.use(Vuex);
//创建vuex仓库
const store = new Vuex.Store({
    //state唯一数据来源  单一状态树
    state: {
        city: '临汾',
        count: 20,
        token: 'qwertyuioplkjhgfdsa',
        searchtime: '',
        msg: 'hello',
        //以下数组为vue技术栈
        skill: ['vue', 'vuerouter', 'vuex', 'axios']
    },
    //类似组件中的计算属性
    getters: {
        //getter接受一个state  然后产生不同的getter
        upperMsg: (state) => state.msg.toUpperCase(),
        skillLength: state => state.skill.length,
        //这个getter不仅依赖于state  还依赖于上一个getters
        getterMsg: (state, getters) => state.city + getters.upperMsg,
        filterSkill(state) {
            return state.skill.filter(ele => ele.includes('vue'))
        },
        filterSkillByMsg(state) {
            return function (msg) {
                return state.skill.filter(ele => ele.includes(msg));
            }
        }
    },
    //修改state的唯一方法  同步修改数据
    //最好提前在你的store中初始化好所有需要的属性
    mutations: {
        //mutation中只能写同步操作 不能写时间函数之类的方法
        //提交方式就是commit+类型  eg：commit('changeCity')
        changeCity(state, city) {
            //本函数的第二个参数用来接收负载
            console.log(city);

            state.city = city;
        },
        changeToken(state, token) {
            state.token = token;
        }
    },
    //通过提交给actions方法 对state进行异步修改
    actions: {
        //分发actions 后 进行异步操作 提交mutation

        handleLogin(context) {
            setTimeout(() => {
                let token = '1234567890';
                context.commit('changeToken', token);
                //context对象是store实例有相同方法和属性的，所以可以直接调用context.commit提交mutation
            }, 2000)
        }
    },
    //开启模块  将大量的数据分成小的模块
    modules: {}
})

export default store;
