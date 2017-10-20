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
use App\Widgets\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller{

    public function index(){
//        dd(TableVersion::updateVersionCache());
    }

    public function permissions(Request $request){
        $params = $request->all();

        $permissions = Permissions::paginate(10);
        $config = new Grid('admin_users');
        $config->initParams($params);
        $config->initPageSize([5,10,15,20]);
        $config->initPlaceholder('Id');
        $config->initTitle([
            (new Row('id','ID'))->sort()->render(),
            (new Row('name',multilingual('backend.permissions.name')))->render(),
            (new Row('slug',multilingual('backend.permissions.slug')))->render(),
            (new Row('created_at',multilingual('backend.permissions.created_at')))->render(),
            (new Row('updated_at',multilingual('backend.permissions.updated_at')))->render()
        ]);
        $config->updateTitleParams($params['sort']);
        return view('backend.index.index')->with([
            'data'  =>  $permissions,
            'grid'  =>  $config->render()
        ]);
    }
}