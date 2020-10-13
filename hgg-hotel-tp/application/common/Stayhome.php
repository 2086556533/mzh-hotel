<?php


namespace app\common;


use think\Model;

class Stayhome extends Model
{
public function edit($data,$where){
    return $this->allowField(true)->isUpdate(true)->where($where)->save($data);
}
}