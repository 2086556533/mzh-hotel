<template>
    <el-container class="main-box">
        <el-header>
            <div class="logo">
            </div>
            <div class="nav">
                <el-menu mode="horizontal">
                    <el-menu-item index="1" style="background: #D3DCE6">指南</el-menu-item>
                    <el-submenu style="background: #D3DCE6"  index="1-2">
                        <template slot="title">
                            <i class="el-icon-user"></i>
                            用户
                        </template>
                        <el-menu-item style="text-align: center"><router-link to="/changepass">修改密码</router-link></el-menu-item>
                        <el-menu-item style="text-align: center" @click="exit">退出登录</el-menu-item>
                    </el-submenu>
                </el-menu>
            </div>
        </el-header>
        <el-container>
            <el-aside width="200px">
                <el-menu>
                    <el-submenu index="1-1">
                        <template slot="title"><i class="el-icon-setting"></i>分类管理</template>
                        <el-menu-item><router-link to="/categoryadd">  <i class="el-icon-plus"></i>分类添加</router-link></el-menu-item>
                        <el-menu-item><router-link :to="{path:'/index'}"><i class="el-icon-view"></i>分类查看</router-link></el-menu-item>
                    </el-submenu>
                    <el-submenu index="1-2">
                        <template slot="title"><i class="el-icon-setting"></i>民宿管理</template>
                        <el-menu-item><router-link to="/stayhomeadd">  <i class="el-icon-plus"></i>民宿添加</router-link></el-menu-item>
                        <el-menu-item><router-link :to="{path:'/index'}"><i class="el-icon-view"></i>民宿查看</router-link></el-menu-item>
                    </el-submenu>
                </el-menu>
            </el-aside>
            <el-container>
                <el-main><router-view></router-view></el-main>
                <el-footer style="text-align: center">

                </el-footer>
            </el-container>
        </el-container>
    </el-container>
</template>

<script>
    export default {
        name: "main",
        methods:{
            exit(){
                sessionStorage.clear();
                this.$router.push('./login');
            }
        }
    }


</script>

<style scoped>
    .main-box{
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
    }
    .el-header, .el-footer {
        background-color: #B3C0D1;
        color: dodgerblue;
        display: flex;
        justify-content: space-between;

    }



    .el-aside {
        background-color: #D3DCE6;
        color: dodgerblue;

    }

    .el-main {
        background:#fff;
        color: #333;
    }




</style>