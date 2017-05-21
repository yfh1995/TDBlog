<?php

namespace App\Models\Base;

use App\Models\Models;

class Configs extends Models{

    protected $table = 'base_configs';

    /**
     * @param $data
     * @return bool|mixed 成功返回插入数据id，否则返回false
     */
    public function add($data){
        $this->module_id = $data['module_id'];
        $this->key = $data['key'];
        $this->value = $data['value'];
        if($this->save()&&$this->updateTableVersion([$this->id])) return $this->id;
        return false;
    }

    /**
     * @param $data
     * @return bool|mixed 成功返回更新数据id，否则返回false
     */
    public function edit($data){
        $config = Configs::find($data['id']);
        $config->module_id = $data['module_id'];
        $config->key = $data['key'];
        $config->value = $data['value'];
        if($config->save()&&$this->updateTableVersion([$this->id])) return $this->id;
        return false;
    }

    /**
     * @param $data
     * @return int 返回删除数据数量
     */
    public function delete($data){
        if($num = $this->destroy($data)&&$this->updateTableVersion($data)) return $num;
        return false;
    }

    protected function updateTableVersion($ids){
        return TableVersion::add([
            'table_name'    =>  $this->table,
            'ids'           =>  $ids
        ]);
    }
}
