<?php

namespace App\Models\Base;

use App\Models\Models;
use App\Util\CacheKey;
use Illuminate\Support\Facades\Cache;

class Configs extends Models{

    const STATUS_OPEN = 0;  //开启配置
    const STATUS_CLOSE = 1; //关闭配置

    protected $table = 'base_configs';

    public static function getStatusCode($status){
        if($status == self::STATUS_OPEN) return '开启';
        else if($status == self::STATUS_CLOSE) return '关闭';
        else return '未知状态';
    }

    /**
     * @param $data
     * @return bool|mixed 成功返回插入数据id，否则返回false
     */
    public function add($data){
        $this->module_id = $data['module_id'];
        $this->key = $data['key'];
        $this->value = $data['value'];
        //更新base_configs表版本
        if($this->save()&&$this->updateTableVersion([$this->id])){
            //更新base_configs表缓存
            $this->updateConfigsCache();
            return $this->id;
        }
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
        if($config->save()&&$this->updateTableVersion([$this->id])){
            //更新base_configs表缓存
            $this->updateConfigsCache();
            return $this->id;
        }
        return false;
    }

    /**
     * @param $data
     * @return int 返回删除数据数量
     */
    public function dele($data){
        if($num = $this->destroy($data)&&$this->updateTableVersion($data)){
            //更新base_configs表缓存
            $this->updateConfigsCache();
            return $num;
        }
        return false;
    }

    public static function updateConfigsCache(){
        $configs = Configs::where('status',Configs::STATUS_OPEN)->get();
        Cache::forever(CacheKey::BaseConfig,$configs->toArray());
        return $configs->toArray();
    }

    protected function updateTableVersion($ids){
        return TableVersion::add([
            'table_name'    =>  $this->table,
            'ids'           =>  $ids
        ]);
    }
}
