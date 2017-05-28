<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/28
 * Time: 13:21
 */

namespace App\Models\Base;


use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model{

    protected $guarded = [];

    protected $table = 'base_role_user';
}