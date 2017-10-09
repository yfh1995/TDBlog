<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/21
 * Time: 23:12
 */

namespace App\Http\ViewComposers;

use App\Facade\User;
use App\Models\Menu;
use Illuminate\Contracts\View\View;

class MenuComposer {

    public function compose(View $view){
        return $view->with([
            'menu' => (new Menu())->getMenu(),
            'permissions'   => User::permissions()
        ]);
    }
}