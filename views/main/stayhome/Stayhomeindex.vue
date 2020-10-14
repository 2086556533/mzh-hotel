<template>
<div>
  <loading :isshow="isShow"></loading>
  <h1>{{msg | capitalize(1)}}</h1>
  <el-form inline :model="search">
    <el-form-item label="所属分类">

    </el-form-item>
    <el-form-item label="民宿名称">
      <el-input v-model="search.sname"></el-input>
    </el-form-item>
    <el-form-item label="民宿城市">
      <el-input v-model="search.scity"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button type="primary">搜索</el-button>
    </el-form-item>
  </el-form>
  <div v-if="stayhome.length">
    <el-table :data="stayhome">
      <el-table-column label="ID" prop="sid"></el-table-column>
      <el-table-column label="名称" prop="sname"></el-table-column>
      <el-table-column label="描述" prop="sdesc"></el-table-column>
      <el-table-column label="价格" prop="sprice"></el-table-column>
      <el-table-column label="特色">
          <template slot-scope="scope">
            <el-button v-for="item in scope.row.stag" :key="item" style="border-radius: 5% 50% 50% 5%">{{item}}</el-button>
          </template>
      </el-table-column>
      <el-table-column label="位置">
        <template slot-scope="scope">
<!--          {{scope.row.ctime|formateTime}}  原来在下面一行的前面显示时间 span后面-->
          <span>  {{scope.row.sprovince}}-- {{scope.row.scity}}-- {{scope.row.sarea}}</span>
        </template>
      </el-table-column>
      <el-table-column label="缩略图" prop="sthumb">
        <template slot-scope="scope">
          <img :src="IMGURL+scope.row.sthumb" alt="">
        </template>
      </el-table-column>
      <el-table-column label="创建时间" prop="ctime">

      </el-table-column>

        <el-table-column label="操作">
          <template slot-scope="scope">
          <el-button type="text">
<!--            如果这个name换成path那么后面不能用params params不能和path一起使用-->
            <router-link :to="{name:'stayhomeedit',params:{id:scope.row.sid}}">编辑</router-link>
          </el-button>
          <el-button>删除</el-button>
          </template>
        </el-table-column>

    </el-table>
  </div>
</div>
</template>

<script>
import instance from "../../../src/http/http";
import loading from "../../../src/components/loading/loading";
import {IMGURL} from "../../../src/lib/base";
import {categoryIndex} from "../../../src/http/category";

export default {
name: "Stayhomeindex",
  data(){
    return{
      categories:[],
      msg:"hello world",
      IMGURL,
      isShow:false,
      search:{sname:'',scity:'',cid:''},
      paginate: {limit:10,page:1},
      stayhome:[],
      total:0
    }
  },
  components:{
    loading
  },
  methods:{
    initStayhome(){
      this.isShow=true;
      let params=Object.assign({},this.search,this.paginate)
      instance.get('/api/stayhome',{
        params
      }).then(res=>{
        this.isShow=false;
        if(res.data){
          let data=res.data;
          data[0].sthumb=IMGURL+''
          data=data.map(ele=>{
            ele.stag=ele.stag.split(/,|，/);
            ele.sthumb=IMGURL+ele.sthumb;
            let date=new Date(ele.ctime*1000);
            ele.ctime=[date.getFullYear(),date.getMonth()+1,date.getDate()].join('-');
            return ele;
          });
          this.stayhome=data;
          this.total=res.total;
        }else {
          this.$message.success('暂无数据');
        }

      }).catch(()=>{

      })
    },
    initCategory(){
      this.isShow=true;
      categoryIndex().then(res=>{
        console.log(res);
        this.categories=res.data;
      }).catch();
    }
  },

  filters: {
    //局部过滤器 就是对上面的那个hello起作用 对别的地方没影响
  },
  mounted() {
  this.initCategory();
    this.initStayhome();
  },
}
</script>

<style scoped>
.el-button{
  padding: 12px 12px;
}
</style>