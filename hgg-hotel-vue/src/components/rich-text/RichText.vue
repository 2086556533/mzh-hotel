<template>
    <div>
        <div id="edit" ref="edit">

        </div>
    </div>
</template>

<script>
    import E from 'wangeditor'
    import {IMGURL,URL} from "../../lib/base";

    export default {
        name: "RichText",
        props:{
            menus:{
                type:Array,
                default:function (){
                    return ['head',  // 标题
                        'bold',  // 粗体
                        'fontSize',  // 字号
                        'fontName',  // 字体
                        'italic',  // 斜体
                        'underline',  // 下划线
                        'strikeThrough',  // 删除线
                        'foreColor',  // 文字颜色
                        'backColor',  // 背景颜色
                        'link',  // 插入链接
                        'list',  // 列表
                        'justify',  // 对齐方式
                        'quote',  // 引用
                        'emoticon',  // 表情
                        'image',  // 插入图片
                        'table',  // 表格
                        'video',  // 插入视频
                        'code',  // 插入代码
                        'undo',  // 撤销
                        'redo' ] // 重复
                }
            },
            value:{
                type:String,
                default:''
            },
            formfield:{
                required:true,
                type:String
            }
        },
        data(){
            return{
                IMGURL,
                uploadurl:URL+'/admin/upload/index'
            }
        },
        methods:{
            initRichText(){
                let that=this;
                let edit=new E(this.$refs.edit);//初始化
                edit.customConfig.menus=this.menus;
                edit.customConfig.showLinkImg=false;
                edit.customConfig.uploadImgServer=this.uploadurl;
                edit.customConfig.uploadFileName='file';
                edit.customConfig.uploadImgMaxSize = 3 * 1024 * 1024
                edit.customConfig.onchange=(html)=>{
                    html;
                    this.$emit('rich-change',this.formfield,html);
                    //this.stayhomeform.sedtail=html;
                }
                //图片上传的监听
                edit.customConfig.uploadImgHooks={
                    customInsert:function (insertImg,result){
                        insertImg(that.IMGURL+result.imgpath);
                    }
                }
                edit.create();//初始化和上面的初始化一起
                this.value && edit.txt.html(this.value);
            }
        },
        mounted() {
            this.initRichText();
        }
    }
</script>

<style scoped>

</style>