<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 16:31
 */

namespace App\Models;


use App\Util\CacheKey;
use App\Util\TablesName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Modules extends Model {

    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = TablesName::ADMIN_MODULES;

    /**
     * 添加一条模块信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加模块信息
        $this->name = $data['name'];
        $this->icon = $data['icon'];
        $this->description = $data['description'];
        $this->url = $data['url'];
        $this->sort = $data['sort'];
        $res_am = $this->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $this->id
        ]);
        if($res_am && $res_atv){
            DB::commit();

            //更新模块缓存
            $this->updateModulesCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新一条模块信息
     * @param array $data
     * @return bool
     */
    public function edit($data){
        DB::beginTransaction();

        //更新模块信息
        if(!($modules = Modules::find($data['id']))){
            DB::rollback();
            return false;
        }
        $modules->name = $data['name'];
        $modules->icon = $data['icon'];
        $modules->description = $data['description'];
        $modules->url = $data['url'];
        $modules->sort = $data['sort'];
        $res_am = $modules->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $modules->id
        ]);
        if($res_am && $res_atv){
            DB::commit();

            //更新模块缓存
            $this->updateModulesCache();
            return $modules->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除模块信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除模块信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新模块缓存
            $this->updateModulesCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新模块缓存信息
     * @return mixed
     */
    public function updateModulesCache(){
        $configs = Modules::get()->toArray();
        Cache::forever(CacheKey::AdminModules,$configs);
        return $configs;
    }
}