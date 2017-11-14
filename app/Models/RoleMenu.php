<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 18:21
 */

namespace App\Models;


use App\Models\Models;
use App\Util\CacheKey;
use App\Util\TablesName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RoleMenu extends Model {

    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = TablesName::ADMIN_ROLE_MENU;

    /**
     * 添加一条角色菜单关联信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加角色菜单关联信息
        $this->role_id = $data['role_id'];
        $this->menu_id = $data['menu_id'];
        $res_arm = $this->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $this->id
        ]);
        if($res_arm && $res_atv){
            DB::commit();

            //更新角色菜单关联缓存
            $this->updateRoleMenuCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除角色菜单关联信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除角色菜单关联信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新角色菜单关联缓存
            $this->updateRoleMenuCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新角色菜单关联缓存信息
     * @return mixed
     */
    public function updateRoleMenuCache(){
        $configs = RoleMenu::get()->toArray();
        Cache::forever(CacheKey::AdminRoleMenu,$configs);
        return $configs;
    }
}