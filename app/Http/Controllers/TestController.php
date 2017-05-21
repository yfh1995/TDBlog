<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/21
 * Time: 15:03
 */

namespace App\Http\Controllers;


use App\Models\Base\TableVersion;

class TestController extends Controller{

    public function index(){
//        $data = [
//            'table_name'    =>  'base_configs',
//            'ids'           =>  [1,2,3]
//        ];
//        dd(TableVersion::edit($data));
        dd(TableVersion::updateVersionCache());
    }
}