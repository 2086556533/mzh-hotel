<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;

class Category extends Controller
{
    public function _initialize()
    {
        parent::_initialize();
        checkToken();
    }

    //添加分类的方法
    public function add()
    {   //判断发送请求的方式是不是POST
        $method=$this->request->method();
        if (!$method) {
            return json([
                'code' => 404,
                'msg' => '请求方式错误'
            ]);
        }
        //
        //将发送的数据赋值给$data
        $data = $this->request->post();
        //添加内置验证方法
        $validate = validate('Category'); //验证器
        $flag=$validate->scene('add')->check($data);
        if (!$flag) {
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        }

        $result = Db::table('category')->insert($data);
        if ($result) {
            return json([
                'code' => 200,
                'msg' => '分类添加成功',
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '分类添加失败'
            ]);
        }
    }

    /**
     *查看数据，分页（limit。page），搜索
     * 前台：查看符合指定条件的某一页的若干条数据
     * 后台：当前台的数据返回时，返回给前台数据总数
     */
    public function index()
    {

        $data = $this->request->get();//接收前台数据

        if (isset($data['page']) && !empty($data['page'])) {
            $page = $data['page'];
        } else {
            $page = 1;
        }//查看是否有分页

        if (isset($data['limit']) && !empty($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = 1;
        }//查看分页里面是否有内容

        $where = [];
        if (isset($data['cname']) && empty($data['cname'])) {
            $where['cname'] = ['like', '%' . $data['cname'] . '%'];//模糊查询
        }//如果前台传入cname的话就搜索

        $category = Db::table('category')->field('cid,cname,cdesc')->where($where)->page($page)->limit($limit)->select();
        $count = Db::table('category')->where($where)->count();
        if ($category && $count) {
            return json([
                'code' => 200,
                'msg' => '数据获取成功',
                'data' => $category,
                'totle' => $count
            ]);
        } else {
            return json([
                'code' => 200,
                'mgs' => '暂无数据',
            ]);
        }

    }

    public function indexall()
    {

        $category = Db::table('category')->field('cid,cname')->select();
        if ($category) {
            return json([
                'code' => 200,
                'msg' => '数据获取成功',
                'data' => $category,
            ]);
        } else {
            return json([
                'code' => 200,
                'mgs' => '暂无数据',
            ]);
        }

    }

    public function read()
    {
        $data = $this->request->get();
        $validate = validate('Category');
        if (!$validate->scene('read')->check($data)) {
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        }
        $category = Db::table('category')->where('cid', $data['cid'])->find();
        if ($category) {
            return json([
                'code' => 200,
                'msg' => '数据读取成功',
                'data' => $category,
            ]);
        } else {
            return json([
                'code' => 200,
                'msg' => '暂无数据'
            ]);
        }
    }

    public function edit()
    {
        $data = $this->request->post();
        $validate = validate('Category');
        if (!$validate->scene('edit')->check($data)) {
            return json([
                'code' => 200,
                'msg' => $validate->getError()
            ]);
        }
        $cid = $data['cid'];
        unset($data['cid']);
        $result = Db::table('category')->where('cid', $cid)->update($data);
        if ($result) {
            return json([
                'code' => 200,
                'msg' => '数据更新成功',
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '数据更新失败',
            ]);
        }
    }
}