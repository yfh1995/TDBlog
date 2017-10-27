<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 17:12
 */

namespace App\Models;


use App\Models\Models;
use App\Util\CacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Resource extends Models{

    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = 'admin_resource';

    /**
     * 添加一条模块资源信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加模块资源信息
        $this->module_id = $data['module_id'];
        $this->key = $data['key'];
        $this->value = $data['value'];
        $res_ar = $this->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $this->id
        ]);
        if($res_ar && $res_atv){
            DB::commit();

            //更新模块资源缓存
            $this->updateResourceCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新一条模块资源信息
     * @param array $data
     * @return bool
     */
    public function edit($data){
        DB::beginTransaction();

        //更新模块资源信息
        if(!($resource = Resource::find($data['id']))){
            DB::rollback();
            return false;
        }
        $resource->module_id = $data['module_id'];
        $resource->key = $data['key'];
        $resource->value = $data['value'];
        $res_ar = $resource->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $resource->id
        ]);
        if($res_ar && $res_atv){
            DB::commit();

            //更新模块资源缓存
            $this->updateResourceCache();
            return $resource->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除模块资源信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除模块资源信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新模块资源缓存
            $this->updateResourceCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新模块资源缓存信息
     * @return mixed
     */
    public function updateResourceCache(){
        $configs = Resource::get()->toArray();
        Cache::forever(CacheKey::AdminResource,$configs);
        return $configs;
    }

    /**
     * 根据模块id获取模块资源信息
     * @param $id
     * @return mixed
     */
    public static function getResourceByModulesId($id){
        return self::find($id);
    }
}