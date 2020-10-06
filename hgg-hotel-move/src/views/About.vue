<template>
    <div class="about">
        <h1>这是关于页{{msg}}</h1>
        <h1>{{count}}</h1>
        <h1>{{city}}</h1>
        <h1>{{token}}</h1>
        <h1>{{msg_computed}}</h1>
        <h1>{{msg}}</h1>


    </div>
</template>

<script>
import {mapState} from 'vuex'
    export default {
        name: 'About',
        data(){
          return {
              msg:'你好'
          }
        },
        //计算方法
        // computed:mapState({
        //     //计算属性的名字可以和store中state的名字不一致
        //     //计算属性里的数据可以不依赖state里面的数据 也可以依赖当前组件中的数据
        //     //使用mapstate可以 一、使用箭头函数  二、使用字符串 三、使用函数使用this
        //     count:state=>state.count,
        //     city:'city',
        //     token:'token',
        //     msg_computed(state){
        //         return state.token+this.msg
        //     }
        // }),
        computed: {
            city() {
                return this.$store.state.city
            },
            count(){
                return this.$store.state.count
            },
            token(){
                return this.$store.state.token
            },
            mymsg(){
                return this.msg.toUpperCase()
            },
            ...mapState({
                count:state=>state.count,
                    city:'city',
                    token:'token',
                    msg_computed(state){
                        return state.city+this.msg
                    }
            })
        },
        mounted() {
            //
            console.log(this.$store.state.city)
        }
    }
</script>

<style scoped>

</style>