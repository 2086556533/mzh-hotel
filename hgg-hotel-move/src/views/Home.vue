<template>
    <div>
        <h1 @click="setCity">{{upperMsg}}</h1>

    </div>
</template>

<script>
    export default {
        name: "Home",
        data() {
            return {}
        },
        computed: {
            //当前组件中的计算属性
            upperMsg() {
                return this.$store.state.msg.toUpperCase()
            },
            // //以下两个是getters
            // skillLength() {
            //     return this.$store.getters.skillLength;
            // },
            // getterMsg() {
            //     return this.$store.getters.getterMsg;
            // },
            // myskiill() {
            //     let arr = this.$store.getters.filterSkill;
            //     return arr;
            // },
            // //通过方法级的方式访问getter  详见store/index.js filterSkillByMsg
            // filterSkillByMsg() {
            //     return this.$store.getters.filterSkillByMsg('r');
            // }
        },
        methods:{
            setCity(){
                //负载要带很多时  要写成对象的形式
                this.$store.commit('changeCity',{city:'临汾',tc:'牛肉丸子面'})
                //通过点击按钮触发事件  分发actions
                this.$store.dispatch('handleLogin');
            },

        }

    }
</script>

<style scoped>

</style>