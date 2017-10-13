<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/21
 * Time: 15:03
 */

namespace App\Http\Controllers;


use App\Models\Permissions;
use App\Widgets\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller{

    public function index(){
//        dd(TableVersion::updateVersionCache());
    }

    public function permissions(Request $request){
        $params = $request->all();

        $permissions = Permissions::paginate(10);
        $config = new Grid();
        $config->initParams($params);
        $config->initPageSize([5,10,15,20]);
        $config->initPlaceholder('Id');
        $config->initTitle([
            ['showName'=>'ID','fieldName'=>'ID'],
            ['showName'=>'name','fieldName'=>multilingual('backend.permissions.name')],
            ['showName'=>'slug','fieldName'=>multilingual('backend.permissions.slug')],
            ['showName'=>'created_at','fieldName'=>multilingual('backend.permissions.created_at')],
            ['showName'=>'updated_at','fieldName'=>multilingual('backend.permissions.updated_at')]
        ]);
        return view('backend.index.index')->with([
            'data'  =>  $permissions,
            'grid'  =>  $config->render()
        ]);
    }
}