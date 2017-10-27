<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 19:03
 */

namespace App\Models;


use App\Models\Models;
use App\Util\CacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserPermissions extends Models {

    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = 'admin_user_permissions';

    /**
     * 添加一条用户权限映射信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加用户权限映射信息
        $this->user_id = $data['user_id'];
        $this->permission_id = $data['permission_id'];
        $res_ar = $this->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $this->id
        ]);
        if($res_ar && $res_atv){
            DB::commit();

            //更新用户权限映射缓存
            $this->updateUserPermissionsCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除用户权限映射信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除用户权限映射信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新用户权限映射缓存
            $this->updateUserPermissionsCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新用户权限映射缓存信息
     * @return mixed
     */
    public function updateUserPermissionsCache(){
        $configs = UserPermissions::get()->toArray();
        Cache::forever(CacheKey::AdminUserPermissions,$configs);
        return $configs;
    }
}