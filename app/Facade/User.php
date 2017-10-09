<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/9
 * Time: 16:43
 */

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Providers\UserProvider
 */
class User extends Facade {

    protected static function getFacadeAccessor() {
        return 'User';
    }
}