import Vue from "vue";
import Vuex from 'vuex'
// import {context} from "vant/lib/mixins/popup/context";
Vue.use(Vuex);
import createPersistedState from 'vuex-persistedstate'
//创建vuex仓库
const store = new Vuex.Store({
    //state唯一数据来源  单一状态树
    state: {
        indexSearch: {
            province: '陕西',
            address: '',
            startTime: '',
            endTime: '',
            startDay: '',
            endDay: '',
        },
    },
    mutations: {
        setTime(state, payload) {
            let weekArr=['Sun','Mon','Tus','Web','Thu','Fri','Sat'];
            let {start, end, startDay, endDay} = payload;
            let date = new Date();
            let startTime = start ? start : date.getMonth() + 1 + '.' + date.getDay();
            let endTime = end ? end : date.getMonth() + 1 + '.' + date.getDay() + 1;
            startDay = startDay === undefined ? date.getDay() : startDay;
            endDay = endDay === undefined ? startDay+1 : endDay;
            state.indexSearch.satrtDay=weekArr[startDay];
            state.indexSearch.endDay=weekArr[endDay];
            state.indexSearch.startTime = startTime;
            state.indexSearch.endTime = endTime;

        },
        setProvince(state, payload) {
            state.indexSearch.province = payload;
        }
    },
    plugin: [createPersistedState()]
})

export default store;
