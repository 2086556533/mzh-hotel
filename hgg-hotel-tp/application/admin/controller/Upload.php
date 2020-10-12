<?php


namespace app\admin\controller;


use think\Controller;

class Upload extends Controller
{

    public function index()
    {
        $file = $this->request->file('file');
        if ($file) {
            $info = $file->validate(['size' => 200 * 1024, 'ext' => 'jpg,png,gif,webp'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                $imgpath = date('Ymd') . '/' . $info->getFilename();
                return json([
                    'code' => 200,
                    'msg' => '图片上传成功',
                    'imgpath' => '/hgg-hotel/hgg-hotel-tp/public/uploads/' . $imgpath
                ]);
            } else {
                return json([
                    'code' => 404,
                    'msg' => $file->getError()
                ]);

            }
        } else {
            return json([
                'code' => 404,
                'msg' => '上传文件不能为空'
            ]);
        }
    }
}