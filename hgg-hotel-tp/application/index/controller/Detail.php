<?php


namespace app\index\controller;


use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Detail extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * /index/detail/id
     */
    public function read($id)
    {
        $stayhomeWhere = ['sid' => $id];
        // 去除当前数据之后 最新4条数据
        $recommendWhere = [
            'sid' => ['<>', $id]
        ];
        try {
            $stayhome = Db::table('stayhome')->where($stayhomeWhere)->find();
            $stayhome['sbanner'] = explode(',', $stayhome['sbanner']);
            $recommend = Db::table('stayhome')->where($recommendWhere)->field('sid,sthumb,sname,sprice,score,scity,sarea')->order('sid', 'desc')->limit(0, 4)->select();

            return json([
                'code' => 200,
                'msg' => '数据获取成功',
                'data' => [
                    'stayhome' => $stayhome,
                    'recommend' => $recommend
                ]
            ]);
        } catch (Exception $exception) {
            return json([
                'code' => 404,
                'msg' => '服务器错误'
            ]);
        }

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}