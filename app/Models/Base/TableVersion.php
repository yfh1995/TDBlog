<?php

namespace App\Models\Base;

use App\Models\Models;
use App\Util\CacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TableVersion extends Models{

    protected $table = 'base_table_version';


    /**
     * 获取受版本控制下的数据表的版本信息
     * @return mixed
     */
    public static function getVersionData(){
        if(!($codes = Cache::get(CacheKey::TableVersion))){
            TableVersion::updateVersionCache();
            $codes = Cache::get(CacheKey::TableVersion);
        }
        return $codes;
    }

    /**
     * 强制更新数据表版本缓存
     */
    public static function updateVersionCache(){
        $version = TableVersion::select(DB::raw('version_code,table_name'))->get();
        Cache::forever(CacheKey::TableVersion,$version->toArray());
        return $version->toArray();
    }

    /**
     *  更新基础配置数据表版本信息
     *  传入格式：
     *  [
     *      'table_name'=>'table_name', //数据变更的数据表名
     *      'ids'=>[1,2,3]              //数据变更id
     *  ]
     * @param $data
     * @return mixed
     */
    public static function edit($data){
        $tableVersion = TableVersion::where('table_name',$data['table_name'])->first();
        $tableVersion->version_code++;
        $rs_tv = $tableVersion->save();
        if($rs_tv) {
            $changes = [];
            foreach($data['ids'] as $v){
                $one = [];
                $one['old_version_code'] = $tableVersion->version_code-1;
                $one['new_version_code'] = $tableVersion->version_code;
                $one['table_name'] = $data['table_name'];
                $one['table_id'] = $v;
                $one['created_at'] = $one['updated_at'] = date('Y-m-d H:i:s');
                $changes[] = $one;
            }
            return TableVersionChanges::add($changes);
        }
        return false;
    }
}
