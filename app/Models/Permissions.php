<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 16:50
 */

namespace App\Models;


use App\User;
use App\Util\CacheKey;
use App\Util\TablesName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Permissions extends Model {
    
    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = TablesName::ADMIN_PERMISSIONS;

    /**
     * 添加一条权限信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加权限信息
        $this->name = $data['name'];
        $this->slug = $data['slug'];
        $res_ap = $this->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $this->id
        ]);
        if($res_ap && $res_atv){
            DB::commit();

            //更新权限缓存
            $this->updatePermissionsCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新一条权限信息
     * @param array $data
     * @return bool
     */
    public function edit($data){
        DB::beginTransaction();

        //更新权限信息
        if(!($permissions = Permissions::find($data['id']))){
            DB::rollback();
            return false;
        }
        $permissions->name = $data['name'];
        $permissions->slug = $data['slug'];
        $res_ap = $permissions->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $permissions->id
        ]);
        if($res_ap && $res_atv){
            DB::commit();

            //更新权限缓存
            $this->updatePermissionsCache();
            return $permissions->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除权限信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除权限信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新权限缓存
            $this->updatePermissionsCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新权限缓存信息
     * @return mixed
     */
    public function updatePermissionsCache(){
        $configs = Permissions::get()->toArray();
        Cache::forever(CacheKey::AdminPermissions,$configs);
        return $configs;
    }

    /**
     * 检查指定用户是否拥有指定权限
     * @param integer $uid
     * @param array $needSlugs
     * @return bool
     */
    public static function checkHavePermissions($uid, $needSlugs){
        $haveSlugs = getPermissionsById($uid);

        foreach ($needSlugs as $v){
            if(!isset($haveSlugs[$v])) {
                return false;
            }
        }
        return true;
    }
}