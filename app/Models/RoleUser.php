<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 18:50
 */

namespace App\Models;


use App\Models\Models;
use App\User;
use App\Util\CacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RoleUser extends Models {

    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = 'admin_role_users';

    /**
     * 添加一条角色用户关联信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加角色用户关联信息
        $this->role_id = $data['role_id'];
        $this->user_id = $data['user_id'];
        $res_ar = $this->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $this->id
        ]);
        if($res_ar && $res_atv){
            DB::commit();

            //更新角色用户关联缓存
            $this->updateRoleUserCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除角色用户关联信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除角色用户关联信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新角色用户关联缓存
            $this->updateRoleUserCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新角色用户关联缓存信息
     * @return mixed
     */
    public function updateRoleUserCache(){
        $configs = RoleUser::get()->toArray();
        Cache::forever(CacheKey::AdminRoleUser,$configs);
        return $configs;
    }
}