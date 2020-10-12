<template>
    <el-form :model="passform"  ref="passform">
        <el-form-item label="旧密码">
            <el-input v-model="passform.oldpass" placeholder="请输入原来的密码" autofocus autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item label="新密码">
            <el-input v-model="passform.newpass" placeholder="请输入新的密码"></el-input>
        </el-form-item>
        <el-form-item label="确认密码">
            <el-input v-model="passform.newpassagain" placeholder="再次输入新密码"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="handlerSubmit">提交</el-button>
        </el-form-item>
    </el-form>

</template>

<script>


    export default {
        name: "Changepass",
        data(){
            return{
                passform:{
                    oldpass:'',
                    newpass:'',
                    newpassagain:''
                },
                passrules:{

                }
            }
        },
        methods:{
            handlerSubmit(){

                let url=URL+'/admin/login/updatepass';
                let token=sessionStorage.getItem('token')
                this.$http({
                    method:'POST',
                    url,
                    data:this.passform,
                    headers:{
                        token
                    }
                }).then(res=>{
                    if(res.status===200&&res.data.code===200){
                        this.$message.success(res.data.msg);
                        sessionStorage.clear();
                        this.$router.push('./login');
                    }
                }).catch(()=>{

                })
            }
        }
    }
</script>

<style scoped>

</style>