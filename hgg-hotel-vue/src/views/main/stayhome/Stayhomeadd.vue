<template>
    <div>
        <loading :isshow="showLoading"></loading>
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
                <el-input type="textarea" v-model="stayhomeform.sname"></el-input>
            </el-form-item>
            <el-form-item label="民宿标签">
                <el-input  v-model="stayhomeform.stag"></el-input>
            </el-form-item>
            <el-form-item label="民宿评分">
                <el-input  v-model="stayhomeform.score"></el-input>
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
                <rich-text formfield="snotice" @rich-change="setSnotice"></rich-text>
                <rich-text :menus="[
            'head',
        'bold',
        'italic',
        'underline'
        ]" value="默认的富文本编辑器"
                           formfield="sdetail" @rich-change="setSnotice"
                ></rich-text>
            </el-form-item>
            <el-form-item>
                <el-button>提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    import {SUCCESS,URL,IMGURL} from "../../../lib/base";
    import loading from "../../../components/loading/Loading";
    import instance from "../../../http/http";
    import E from 'wangeditor';
    import RichText from "../../../components/rich-text/RichText";
    import city from "../../../lib/city.json";

    export default {
        name: "Stayhomeadd",
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
                stayhomeform:{
                    sname:'',
                    sdesc:'',
                    sthumb:'',
                    sprice:'',
                    stag:'',
                    sprovince:'',
                    scity:'',
                    sarea:'',
                    saddress:'',
                    sbanner:'',
                    snotice:'',
                    sdetail:'',
                    cid:'',
                    score:'',
                },
                bannerArr:[],
                city,
                province:[],
            }
        },
        computed:{
            cityList(){
                let cityLists=[];
                let current=this.city.find(ele=>ele.name===this.stayhomeform.sprovince);
                if(current){
                    cityLists=current.city.map(ele=>ele.name);
                }
                return cityLists;
            },
            areaList(){
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
            initCategory(){
                this.showLoading=true;
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
                let url=file.response.imgpath;
                this.bannerArr=this.bannerArr.filter(ele=>ele!=url);
                this.stayhomeform.sbanner=this.bannerArr.join(',');
            },

            handleBannerPreview(file){
                //预览banner
                let url=this.IMGURL+file.response.imgpath;
                this.dialogImageUrl=url;
                this.dialogVisible=true;
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



            testAxios(){
                instance.get('/admin/category/indexall').then(res=>{
                    console.log(res);
                })
            }
        },
        mounted() {
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