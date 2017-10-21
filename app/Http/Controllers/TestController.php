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
        $grid = new Grid('admin_permissions');
        $grid->initParams($params);
        $grid->initPageSize([5,10,15,20]);
        $grid->initPlaceholder('Id');
        $grid->initTitle([
            (new Row('id','ID'))->sort(),
            (new Row('name',multilingual('backend.permissions.name'))),
            (new Row('slug',multilingual('backend.permissions.slug'))),
            (new Row('created_at',multilingual('backend.permissions.created_at'))),
            (new Row('updated_at',multilingual('backend.permissions.updated_at')))
        ]);
        if(isset($params['sort'])) {
            $grid->updateTitleParams($params['sort']);
        }
        return view('backend.index.index')->with($grid->render());
    }
}