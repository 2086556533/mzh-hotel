<?php


namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
//规则
    protected $rule=[
        'cid'=>'require|number',
        'cname'=>'require|chsAlphaNum',
        'cdesc'=>'require|chsAlphaNum',
    ];
    //提示信息
    protected $message=[
        'cid.require'=>'cid必填',
        'cid.number'=>'cid只能是数字',
        'cname.require'=>'分类名称必填',
        'cname.chsAlphaNum'=>'分类名称只能包含汉字字母',
        'cdesc.require'=>'分类名称必填',
        'cdesc.chsAlphaNum'=>'分类名称只能包含汉字字母',
    ];
    //场景
    protected $scene=[
        'add'=>'cname,cdesc',
        'read'=>'cid',
        'edit'=>'cid,cname.cdesc'
    ];
}