<template>
    <div>
        <!--       vue 循环v-for     :表示v-bind  绑定数据 :数据名=’数据值‘ -->
        <div v-for="item in provinceKeys" :key="item" class="small">
            <h2>{{item}}</h2>
            <ul>
                <li v-for="(city,index) in province[item]" :key="index" @click="handleProvince(city.city)">
                    <a href="#" style="display: block;line-height: 2rem;color: black">{{city.city}}</a>
                </li>
            </ul>
        </div>
    </div>
</template>


<script>
    import city from '../../lib/city(1).json'

    export default {
        name: "Province",
        data() {
            return {
                province: {}
            }
        },
        //计算属性
        computed: {
            provinceKeys() {
                let arr = [];
                if (JSON.stringify(this.province) != '{}') {
                    arr = Object.keys(this.province).sort();
                }
                return arr;

            }
        },
        //使用methods属性为组件定义方法
        methods: {
            //初始化省份
            initProvince() {
                //遍历省份列表中的城市拼音
                city.province.forEach(ele => {
                    //将拼音首字母变成大写  charAt（）功能：返回下标为index的子字符串
                    //参数: 数字下标
                    //返回值: 对应下标字符串
                    let firstChar = ele.en.charAt(0).toUpperCase();
                    //如果不存在当前省份的首字母  创建当前首字母的分类
                    if (!this.province[firstChar]) {
                        // this.province[firstChar] = [];
                        this.$set(this.province, firstChar, []);
                    }
                    //如果存在   将当前数据推入已有数组
                    this.province[firstChar].push(ele);
                })
            },
            //点击省份调用store中的设置省份方法
            handleProvince(province){
                this.$store.commit('setProvince',province)
                this.$router.back()
            }
        },
        mounted() {

            //以下对象放置按首字母归类好的省份列表
            this.initProvince();

        }
    }
</script>

<style scoped>
    h2 {
        color: goldenrod;

    }

    li {
        margin-left: 1rem;
        line-height: 2rem;
    }

    .small {
        margin-left: 2rem;
    }

    .big {
        margin-left: 2rem;
    }
</style>