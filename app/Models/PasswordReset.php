<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/6/24
 * Time: 22:54
 */

namespace App\Models;


use App\Util\TablesName;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model {

    protected $table = TablesName::PASSWORD_RESETS;

}