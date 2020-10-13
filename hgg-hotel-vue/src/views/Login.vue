<template>
    <div class="login" ref="login">
        <div class="login-content">
            <el-form ref="loginform" :model="loginForm" :rules="rules" class="demo-ruleForm">
                <el-form-item label="用户名" prop="username" autocomplete="on">
                    <el-input v-model="loginForm.username" auto-complete="off"></el-input>
                </el-form-item>

                <el-form-item label="密  码" prop="password">
                    <el-input v-model="loginForm.password" type="password"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click.prevent="handleLogin">登录</el-button>
                </el-form-item>
            </el-form>

        </div>
    </div>
</template>


<script>
    import axios from 'axios';
    import {SUCCESS, URL} from "../lib/base";

    export default {
        name: "login",
        data() {
            return {
                loginForm: {username: '', password: ''},
                rules: {
                    username: [
                        {required: true, message: "请输入用户名", trigger: 'blur'},
                        {min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: "请输入密码", trigger: 'blur'},
                        {min: 3, max: 8, message: '长度在 3 到 8 个字符', trigger: 'blur'}
                    ]
                }
            };
        },
        methods: {
            handleLogin() {
                this.$refs.loginform.validate(validate => {
                    if (validate) {
                        const loginagain = axios.post(URL + '/admin/Login/check', this.loginForm);
                        loginagain.then((res) => {
                            if (res.status === 200 && res.data.code === SUCCESS) {
                                sessionStorage.setItem('token', res.data.token);//登录成功把token存到本地
                                sessionStorage.setItem('user', JSON.stringify(res.data.user));
                                let redirect = this.$route.query.redirect || 'index';
                                this.$router.push({name: redirect})
                                alert('登陆成功');
                            } else {
                                this.$message.error(res.data.msg)//发送错误信息
                            }
                        }).catch(function (error) {
                            console.log(error)
                        })

                        // this.$router.push({path:"/"})

                    } else {
                        console.log('登录失败');
                        return false;
                    }
                });
            },
            // console.log(this.loginForm);
            // console.log(this.$refs);

            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }

</script>

<style scoped>
    .login {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        background-image: url("../assets/login-background.jpg");
        background-repeat: no-repeat;
        background-size: cover;
    }

    .login > .login-content {
        width: 400px;
        height: auto;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-image: url("../assets/login-background.jpg");

        padding: 20px;
        text-align: center;
    }
</style>