<template>
  <div>
    <loading :isshow="showLoading"></loading>
    <div>
    <el-form :model="stayhomeform" ref="stayhomeform">
        <el-form-item label="所属分类">
          <el-select v-model="stayhomeform.cid" placeholder="请选择">
            <el-option
                v-for="item in categories"
                :key="item.cid"
                :label="item.cname"
                :value="item.cid">
            </el-option>
          </el-select>
        </el-form-item>
      <el-form-item label="民宿名称">
        <el-input v-model="stayhomeform.sname"></el-input>
      </el-form-item>
      <el-form-item label="民宿描述">
        <el-input type="textarea" v-model="stayhomeform.sdesc"></el-input>
      </el-form-item>
      <el-form-item label="民宿标签">
        <el-input  v-model="stayhomeform.stag"></el-input>
      </el-form-item>
      <el-form-item label="民宿评分">
        <el-input  v-model="stayhomeform.sscore"></el-input>
      </el-form-item>
      <el-form-item label="民宿价格">
        <el-input  v-model="stayhomeform.sprice"></el-input>
      </el-form-item>
      <el-form-item label="民宿省份">
        <el-select v-model="stayhomeform.sprovince">
          <el-option v-for="(item,index) in province" :value="item" :label="item" :key="index">
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="民宿城市">
        <el-select v-model="stayhomeform.scity">
          <el-option v-for="(item,index) in cityList" :value="item" :label="item" :key="index">
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="民宿区域">
        <el-select v-model="stayhomeform.sarea">
          <el-option v-for="(item,index) in areaList" :value="item" :label="item" :key="index">
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="民宿地址">
        <el-input  v-model="stayhomeform.sarea"></el-input>
      </el-form-item>
      <el-form-item label="民宿缩略图">

      </el-form-item>
      <el-form-item>
        <el-upload
            class="avatar-uploader"
            :action="uploadurl"
            :show-file-list="false"
            :on-success="handleThumbSuccess"
            :before-upload="handleThumbBeforeload">

          <img v-if="stayhomeform.sthumb" :src="IMGURL+stayhomeform.sthumb" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon"></i>
          <div slot="tip" class="el-upload__tip" style="color: red">只能上传jpg/png/jpeg/webp文件，且不超过1000kb,最佳比例1:1</div>
        </el-upload>
      </el-form-item>
      <el-form-item label="民宿轮播">

      </el-form-item>
      <el-form-item>
        <el-upload
            class="avatar-uploader"
            :action="uploadurl"
            list-type="picture-card"
            multiple
            :limit="5"
            :file-list="bannerFileList"
            :on-exceed="handleExceed"
            :on-success="handleBannerSuccess"
            :on-remove="handleBannerRemove"
            :on-preview="handleBannerPreview"
            >

          <i class="el-icon-plus"></i>
          <div slot="tip" class="el-upload__tip" style="color: red">只能上传jpg/png/jpeg/webp文件，且不超过1000kb,最佳比例1:1,最多只能上传5张</div>
        </el-upload>
        <el-dialog :visible.sync="dialogVisible">
          <img  width="100%" :src="dialogImageUrl" alt="">
        </el-dialog>
      </el-form-item>
      <el-form-item label="民宿详情">

      </el-form-item>
      <el-form-item>
        <div id="sdetail" ref="sdetail">

        </div>
      </el-form-item>
      <el-form-item label="入住须知">

      </el-form-item>
      <el-form-item>
        <rich-text formfield="snotice" @rich-change="setSnotice" :value="stayhomeform.snotice"></rich-text>
        <rich-text :menus="[
            'head',
        'bold',
        'italic',
        'underline'
        ]" :value="stayhomeform.sdetail"
                   formfield="sdetail" @rich-change="setSnotice"
        ></rich-text>
      </el-form-item>
      <el-form-item>
      <el-button @click="Submit">提交</el-button>
      </el-form-item>
    </el-form>
  </div>
  </div>
</template>

<script>
import {SUCCESS, URL, IMGURL, FAIL} from "../../../src/lib/base";
import loading from "../../../src/components/loading/loading";
import instance from "../../../src/http/http";
import E from 'wangeditor';
import RichText from "../../../src/components/rich-text/RichText";
import city from "../../../src/lib/city.json";
import {categoryIndex} from "../../../src/http/category";
import {stayhomeRead,stayhomeUpdate} from "../../../src/http/stayhome";
import axios from "axios";

export default {
name: "Stayhomeedit",
  components:{
    loading,
    RichText
  },
  data(){
  return {
    IMGURL,
    uploadurl: URL+'/admin/upload/index',
    dialogImageUrl:'',
    dialogVisible:false,
    showLoading:true,
      categories:[],
      stayhomeform:null,
      bannerArr:[],
      city,
      province:[],
      bannerFileList:[],
    }
  },
  computed:{
      cityList(){
        //城市列表
        let cityLists=[];
        let current=this.city.find(ele=>ele.name===this.stayhomeform.sprovince);
        if(current){
          cityLists=current.city.map(ele=>ele.name);
        }
        return cityLists;
      },
    areaList(){
        //地区列表
      let area=[];
      let current=this.city.find(ele=>ele.name === this.stayhomeform.sprovince);
      if(current){
        let city=current.city.find(ele=>ele.name === this.stayhomeform.scity);
        if(city){
          area=city.area;
        }
      }
      return area;
    },
  },
  methods:{
    Submit(){

      this.$refs.stayhomeform.validate(valid=>{
        if(valid){
          console.log(666)
          let url=URL+'/admin/category/editall';
          let token=sessionStorage.getItem('token');
          SUCCESS,FAIL;
          axios({
            url,
            method:'POST',
            data:this.stayhomeform,
            headers:{
              token
            }
          }).then(res=>{
            if(res.status===200&&res.data.code===SUCCESS){
              this.$message.success(res.data.msg)
            }
          }).catch(()=>{
            this.$message.error("分类添加失败")
          })
        }
      })
    },
    initCategory(){
      this.showLoading=true;
      categoryIndex();
      instance('/admin/category/indexall').then(res=>{
        this.showLoading=false;
        if(res.code===SUCCESS){
          this.categories=res.data;
        }
      }).catch(()=>{

      })
    },

    handleThumbSuccess(res){
    //缩略图上传成功
      if(res.code===SUCCESS){
        this.stayhomeform.sthumb=res.imgpath;
      }
    },

    handleThumbBeforeload(file){
      let {size,type}=file;

      let UploadMaxSize =1000*1024;
      let UploadType=['image/jpg','image/png','image/jpeg','image/webp']
      let sizeFlag=true,typeFlag=true;
      sizeFlag=size<UploadMaxSize;
      typeFlag=UploadType.some(ele=>ele==type);
      if (!typeFlag) {
        this.$message.error('上传头像图片只能是 JPG/PNG/JPEG/WEBP 格式!');
      }
      if (!sizeFlag) {
        this.$message.error('上传头像图片大小不能超过 1MB!');
      }
      return sizeFlag&&typeFlag;
    },

    handleBannerSuccess(res){
      //多图片轮播上传
      this.bannerArr.push(res.imgpath);
      this.stayhomeform.sbanner=this.bannerArr.join(',');
    },

    handleBannerRemove(file){
    //删除banner
      let url=file.response ? file.response.imgpath:file.url
      this.bannerArr=this.bannerArr.filter(ele=>url.includes(ele));
      this.stayhomeform.sbanner=this.bannerArr.join(',');
    },

    handleBannerPreview(file){
      //预览banner


      this.dialogVisible=true;
      let url;
      if(file.response){
         url=this.IMGURL+file.response.imgpath;
      }else{
        url=file.url;
      }
      this.dialogImageUrl=url;
    },

    handleExceed(files, fileList) {
      //提示超出上传限制文件的个数
      this.$message.warning(`当前限制选择 5 个文件，本次选择了 ${files.length} 个文件，共选择了 ${files.length + fileList.length} 个文件`);
    },

    initRichText(){
      //富文本编辑器
      let that=this;
      let edit=new E(this.$refs.sdetail);
      //edit.customConfig.uploadImgShowBase64=true;
      edit.customConfig.showLinkImg=false;
      edit.customConfig.uploadImgServer=this.uploadurl;
      edit.customConfig.uploadFileName='file';
      edit.customConfig.onchange=(html)=>{
        this.stayhomeform.sedtail=html;
      }
      //图片上传的监听
      edit.customConfig.uploadImgHooks={
        customInsert:function (insertImg,result){
          insertImg(that.IMGURL+result.imgpath);
        }
      }
      edit.create();
    },

    setSnotice(field,html){
        this.stayhomeform[field]=html;
    },

    setProvince(){
      //省份列表
      this.province=this.city.map(ele=>ele.name)
    },

    initStayhome(sid){
      stayhomeRead(sid).then(res=>{

        if(res.data){

          this.stayhomeform=res.data;
          this.bannerArr=res.data.sbanner1;
          res.data.sbanner1
          this.bannerFileList=res.data.sbanner1.map(ele=>({name:res.data.sname,url:this.IMGURL+ele}))
        }
      }).catch(error=>{
        console.log(error);
      })
    },

    handlerSubmit(){
      stayhomeUpdate(this.stayhomeform.sid,this.stayhomeform);
    },


    testAxios(){
instance.get('/admin/category/indexall').then(res=>{
  console.log(res);
})
  }
  },
  mounted() {
    let sid=this.$route.params.id;
    this.initStayhome(sid);
    this.initCategory();
    this.initRichText();
    this.setProvince();
  }
}
</script>

<style>
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409EFF;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
</style>