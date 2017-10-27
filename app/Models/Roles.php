<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 17:39
 */

namespace App\Models;


use App\Models\Models;
use App\User;
use App\Util\CacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Roles extends Models {

    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = 'admin_roles';

    /**
     * 添加一条角色资源信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加角色资源信息
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

            //更新角色资源缓存
            $this->updateRolesCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新一条角色资源信息
     * @param array $data
     * @return bool
     */
    public function edit($data){
        DB::beginTransaction();

        //更新角色资源信息
        if(!($roles = Roles::find($data['id']))){
            DB::rollback();
            return false;
        }
        $roles->module_id = $data['module_id'];
        $roles->key = $data['key'];
        $roles->value = $data['value'];
        $res_ar = $roles->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $roles->id
        ]);
        if($res_ar && $res_atv){
            DB::commit();

            //更新角色资源缓存
            $this->updateRolesCache();
            return $roles->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除角色资源信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除角色资源信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新角色资源缓存
            $this->updateRolesCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新角色资源缓存信息
     * @return mixed
     */
    public function updateRolesCache(){
        $configs = Roles::get()->toArray();
        Cache::forever(CacheKey::AdminRoles,$configs);
        return $configs;
    }

    //==========================================================================================
    //=================================模型关联=================================================
    //==========================================================================================

    /**
     * 关联：角色-权限
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(){
        return $this->belongsToMany(Permissions::class,'admin_role_permissions','role_id','permission_id');
    }

    /**
     * 关联：角色-用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user(){
        return $this->belongsToMany(User::class,'admin_role_users','role_id','user_id');
    }
}