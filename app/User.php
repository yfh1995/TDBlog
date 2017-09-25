<?php

namespace App;

use App\Models\Admin\Permissions;
use App\Models\Admin\Roles;
use Illuminate\Foundation\Auth\User as Authenticatable;

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



    //==========================================================================================
    //=================================模型关联=================================================
    //==========================================================================================

    /**
     * 关联：用户-角色
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(){
        return $this->belongsToMany(Roles::class,'admin_role_user','user_id','role_id');
    }

    /**
     * 关联：用户-权限
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(){
        return $this->belongsToMany(Permissions::class,'admin_user_permissions','user_id','permission_id');
    }
}
