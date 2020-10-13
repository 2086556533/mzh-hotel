<?php


namespace app\common;


use think\Model;

class Orders extends Model
{
    protected $autoWriteTimestamp = true;
    protected $table = 'orders';

    public function add($data)
    {
        return $this->allowField(true)->isUpdate()->save($data);
}
}