<template>
    <div>
        <loading :isShow="isShow"></loading>
        <el-form inline :model="search">
            <el-form-item label="所属分类"></el-form-item>
        </el-form>
        <el-form-item label="民俗名称">
            <el-input v-model="search.sname"></el-input>
        </el-form-item>
        <el-form-item label="民俗城市">
            <el-input v-model="search.scity"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary">搜索</el-button>
        </el-form-item>

        <el-table :data="stayhome">
            <el-table-column label="ID" prop="sid"></el-table-column>
            <el-table-column label="名称" prop="sname"></el-table-column>
            <el-table-column label="描述" prop="sdesc"></el-table-column>
            <el-table-column label="价格" prop="sprice"></el-table-column>
            <el-table-column label="标签" prop="stag">
                <template>
                    <el-button>

                    </el-button>
                </template>
            </el-table-column>
            <el-table-column label="位置">

            </el-table-column>
            <el-table-column label="缩略图" prop="sthumb">

            </el-table-column>
        </el-table>
    </div>
</template>

<script>

    import instance from "../../../http/http";
    import loading from "../../../components/loading/Loading";
    import {IMGURL} from "../../../lib/base";

    export default {
        name: "Stayhomeindex",
        data(){
            return {
                isShow:false,
                //定义搜索条件
                search:{
                    sname:'',scity:'',cid:''
                },
                //定义分页
                paginate:{
                    limit:5,page:1
                },
                //初始化要展示的数据
                stayhome:[],
            }
        },
        computed:{
            loading
        },
        methods:{
            initstayhome(){
                this.isShow=true;
                let params=Object.assign({},this.search,this.paginate);
                instance.get('/api/stayhome/',{
                    params
                }).then(res=>{
                    this.isShow=false;
                    if(res.data) {
                        let data=res.data;
                        data[0].sthumb=IMGURL+'';
                        data= data.map(ele=>{
                            ele.stag=ele.stag.split(/，|,/);
                            ele.sthumb=IMGURL+ele.sthumb;
                            let data=new Date(ele.ctime*1000);
                            ele.ctime=[data.getFullYear(),data.getMonth(),data.getData()]
                            return ele;
                        })
                    }
                }).catch(()=>{

                })
            }
        },
        //过滤器用来过滤文本内容
        //过滤器使用的位置有两个  大括号插值的地方   v-bind的地方
        filters:{

        },
        //mouted发送请求
        mounted() {
            this.initstayhome();
        }

    }

</script>

<style scoped>

</style>