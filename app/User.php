<?php

namespace App;

use App\Models\Permissions;
use App\Models\Roles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{

    const ACTIVATED_NO = 0;     //账号未激活
    const ACTIVATED_YES = 1;    //账号已激活

    protected $table = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','activation_code','activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function user(){
        return Auth::guard(config('admin.prefix'))->user();
    }

    /**
     * 根据用户id获取用户角色
     * @param $id
     * @return array
     */
    public static function getRolesById($id){
        $res = User::with('roles')->find($id);
        $ids = [];
        foreach ($res->roles as $v){
            $ids[$v->slug] = $v->id;
        }
        return $ids;
    }

    /**
     * 根据用户id获取用户权限
     * @param $id
     * @return array
     */
    public static function getPermissionsById($id){
        $res = User::with('permissions','roles.permissions')->find($id);
        $ids = [];
        foreach ($res->permissions as $v)
            $ids[$v->slug] = $v->id;
        foreach ($res->roles as $v)
            foreach ($v->permissions as $val)
                if(!isset($ids[$val->slug]))
                    $ids[$val->slug] = $val->id;
        return $ids;
    }

    //==========================================================================================
    //=================================模型关联=================================================
    //==========================================================================================

    /**
     * 关联：用户-角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany(Roles::class,'admin_role_users','user_id','role_id');
    }

    /**
     * 关联：用户-权限
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(){
        return $this->belongsToMany(Permissions::class,'admin_user_permissions','user_id','permission_id');
    }
}
