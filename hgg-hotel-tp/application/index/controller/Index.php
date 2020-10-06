<?php

namespace app\index\controller;

use think\Controller;
use think\Db;


class Index extends Controller
{
    public function lists()
    {
        $student = Db::table('user')->select();
        $data = ['name' => 'zhangsan', 'age' => 20];
        $skill = ['html', 'css', 'js'];
        $this->assign('person', $data);
        $this->assign('skill', $skill);
        $this->assign('student', $student);
        return $this->fetch();
    }

    public function index()
    {
        //从数据库拿轮播图
        $banner = Db::table('stayhome')->order()->limit()->select();
        //从数据库拿分类
        $category = Db::table('category')->order()->select();
        foreach ($category as $item) {
            $cid = $item['cid'];
            $goods = Db::table()->where('cid', $cid)->order()->limit();
            $item['goods']=$goods;
        }
        return json([
            'code'=>200,
            'msg'=>'',
            'data'=>[
                'banner'=>$banner,
                'category'=>$category
            ]
        ]);

    }
}
