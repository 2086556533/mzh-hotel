<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\JWT;

class Login extends Controller
{
    //登录校验
    public function check()

    {   //接受前台的请求方式
        $method = $this->request->method();
//        echo $method;
        //判断前台的请求方式是不是POST
        if ($method != 'POST') {
            //如果请求方式不是POST返回请求方式错误
            return json([
                'code' => 404,
                'msg' => '请求方式错误'
            ]);
        };
        //将请求的数据传给data
        $data = $this->request->post();
//        echo $data;
        //添加一个内置对象验证器validate
        $validate = validate('Login');//验证器
        //scene指定验证场景为login控制器
        $flag = $validate->scene('login')->check($data);
        //判断验证的结果
        if (!$flag) {
            //如果不是直接报错
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        };
        //判断数据库中的username是否和传入的username一致
        $whereArr = ['username' => $data['username']];
        //根据传入的用户名找到数据库中对应的用户数据
        $user = Db::table('admin')->where($whereArr)->find();
        if ($user) {
            //将传入的密码进行加密并与数据库中的密码进行比较
            $password = md5(crypt($data['password'], config('salt')));
            if ($password === $user['password']) {
                // 将用户数据回传
                $payload = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'handview' => $user['handview']
                ];
                // 为本次登录设置token
                $token = JWT::getToken($payload, config('jwtkey'));
                echo $token;

                // 返回登陆成功
                return json([
                    'code' => 200,
                    'msg' => '登录成功',
                    'token' => $token,
                    'user' => $payload,
                ]);
            } else {
                return json([
                    'code' => 404,
                    'msg' => '登陆失败',

                ]);
            }
        } else {
            return json([
                'code' => 404,
                'msg' => '用户不存在'
            ]);
        }

    }

    //修改密码
    public function updatepass()
    {
        checkToken();
        if (!$this->request->isPost()) {
            return json([
                'code' => 404,
                'msg' => '请求方式错误'
            ]);
        }

        $data = $this->request->post();
        $validate = validate('Login');
        if (!$validate->scene('chagepass')->check($data)) {
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        }
        $id = $this->request->id;
        $oldpass = secretPassword($data['oldpass']);
        $newpass = secretPassword($data['newpass']);

        if ($oldpass == $newpass) {
            return json([
                'code' => 404,
                'msg' => '新密码和原密码不能相同'
            ]);
        }

        $result = Db::table('admin')->field('password')->where('id', $id)->find();
        $password = $result['password'];

        if ($password != $oldpass) {
            return json([
                'code' => 404,
                'msg' => '原密码错误'
            ]);
        }

        $result = Db::table('admin')->where('id', $id)->update(['password' => $newpass]);

        if ($result) {
            return json([
                'code' => 200,
                'msg' => '数据更新成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '数据更新失败'
            ]);
        }
    }
}