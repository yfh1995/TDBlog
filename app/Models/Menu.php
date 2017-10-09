<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/25
 * Time: 13:41
 */

namespace App\Models;


use App\Models\Models;
use App\Util\CacheKey;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Menu extends Models {

    //当前表在版本控制中的id
    const TABLE_VERSION_NO = 1;

    protected $table = 'admin_menu';

    /**
     * 添加一条菜单信息
     * @param array $data
     * @return bool|mixed
     */
    public function add($data){
        DB::beginTransaction();

        //添加菜单信息
        $this->parent_id = $data['parent_id'];
        $this->order = $data['order'];
        $this->title = $data['title'];
        $this->icon = $data['icon'];
        $this->uri = $data['uri'];
        $res_am = $this->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $this->id
        ]);
        if($res_am && $res_atv){
            DB::commit();

            //更新菜单缓存
            $this->updateMenuCache();
            return $this->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新一条菜单信息
     * @param array $data
     * @return bool
     */
    public function edit($data){
        DB::beginTransaction();

        //更新菜单信息
        if(!($menu = Menu::find($data['id']))){
            DB::rollback();
            return false;
        }
        $menu->parent_id = $data['parent_id'];
        $menu->order = $data['order'];
        $menu->title = $data['title'];
        $menu->icon = $data['icon'];
        $menu->uri = $data['uri'];
        $res_am = $menu->save();

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $menu->id
        ]);
        if($res_am && $res_atv){
            DB::commit();

            //更新菜单缓存
            $this->updateMenuCache();
            return $menu->id;
        }
        DB::rollback();
        return false;
    }

    /**
     * 删除菜单信息
     * @param $data
     * @return bool|int
     */
    public function dele($data){
        DB::beginTransaction();

        //删除菜单信息
        $num = $this->destroy($data);

        //更新版本信息
        $res_atv = TableVersion::renew([
            'table_id'  =>  $this::TABLE_VERSION_NO,
            'ids'       =>  $data
        ]);
        if($num == count($data) && $res_atv){
            DB::commit();

            //更新菜单缓存
            $this->updateMenuCache();
            return $num;
        }
        DB::rollback();
        return false;
    }

    /**
     * 更新菜单缓存信息
     * @return mixed
     */
    public function updateMenuCache(){
        $configs = Menu::all()->toArray();
        Cache::forever(CacheKey::AdminMenu,$configs);
        return $configs;
    }

    /**
     * 获取树形化的菜单数组
     * @return array
     */
    public function getMenu(){
        if(!($menu = Cache::get(CacheKey::AdminMenu))){
            $menu = $this->updateMenuCache();
        }
        return convertToTreeStructure($menu,'parent_id','id','children',0);
    }
}