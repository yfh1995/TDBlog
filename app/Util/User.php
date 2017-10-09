<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/9
 * Time: 16:50
 */

namespace App\Util;


use Illuminate\Support\Facades\Auth;

class User {

    protected $user,$roles,$permissions;

    public function __construct(){
        if(Auth::guard(config('admin.prefix'))->guest()){
            $this->user = [];
            $this->roles = [];
            $this->permissions = [];
        }else{
            $user = user();
            $this->user = $user;
            $this->roles = getRolesById($user->id);
            $this->permissions = getPermissionsById($user->id);
        }
    }

    public function user(){
        return $this->user;
    }

    public function roles(){
        return $this->roles;
    }

    public function permissions(){
        return $this->permissions;
    }
}