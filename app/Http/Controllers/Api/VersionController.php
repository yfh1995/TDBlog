<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/11/14
 * Time: 17:27
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\TableVersionChanges;
use App\Services\CacheService;
use App\Util\CacheKey;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 版本控制
 *
 * 一部分为数据表缓存（常驻缓存），包含版本控制之内和之外的数据
 * 一部分为零散缓存（常驻缓存）
 *
 * Class VersionController
 * @package App\Http\Controllers\Api
 */
class VersionController extends Controller {

    //==========================================================================
    //============================常驻版本控制===================================
    //==========================================================================

    /**
     * 版本校验，返回版本间的差异数据
     * @param Request $request
     * @return string
     */
    public function checkVersion(Request $request){
        //获取数据表版本控制内的数据
        $res = $this->balanceVersion($request);

        //添加数据表版本控制外的数据（如：个性化数据）
        $data = TableVersionChanges::getAllPrivateTableData();
        foreach ($data as $k=>$v){
            if(isset($res['data'][$k])){
                $res['data'][$k] = array_merge($res['data'][$k],$v);
            }
        }

        return Tool::apiOutput($res['code'],$res['data']);
    }

    /**
     * 版本验证，只返回数据，方便对内对外调用
     * @param $request
     * @return array|string
     */
    public function balanceVersion($request){
        $res = $this->versionValidation($request);
        if($res['code'] != Codes::SUCCESS){
            return Tool::apiOutput($res['code'],$res['data']);
        }

        return TableVersionChanges::getVersionTableData($request->get('version_code'));
    }

    /**
     * 验证版本接口参数验证
     * @param $request
     * @return array
     */
    private function versionValidation($request){
        $validation = Validator::make($request->all(),[
            'version_code'  =>  'required'
        ],[
            'version_code.required' =>  multilingual('prompt.version_code').multilingual('prompt.valRequired')
        ]);

        if($validation->fail()){
            return Tool::withinOutput(Codes::PARAMS_ERROR,$validation->errors()->all());
        }

        return Tool::withinOutput(Codes::SUCCESS);
    }


    //==========================================================================
    //============================常驻零散缓存控制===============================
    //==========================================================================

    /**
     * 获取所有非表数据缓存的键
     * @return string
     */
    public function getCacheKeys(){
        $cacheKeys = Tool::getClassConstants(new CacheKey());

        foreach ($cacheKeys as $k=>$v){
            if(explode('_',$v)[0] != CacheService::SCATTERED){
                unset($cacheKeys[$k]);
            }
        }
        return Tool::apiOutput(Codes::SUCCESS,$cacheKeys);
    }

    /**
     * 获取常驻非表数据缓存
     * @param Request $request
     * @param CacheService $cache
     * @return string
     */
    public function getCache(Request $request, CacheService $cache){
        $res = $this->cacheValidation($request);
        if($res['code'] != Codes::SUCCESS){
            return Tool::apiOutput($res['code'],$res['data']);
        }

        $cacheKeys = $request->get('cache_keys');
        $cacheKeys = explode(',',$cacheKeys);

        $res = $cache->getCache($cacheKeys);
        return Tool::apiOutput($res['code'],$res['data']);
    }

    /**
     * 验证缓存接口参数验证
     * @param $request
     * @return array
     */
    private function cacheValidation($request){
        $validation = Validator::make($request->all(),[
            'cache_keys' =>  'required'
        ],[
            'cache_keys.required'    =>  multilingual('prompt.cache_keys').multilingual('prompt.valRequired')
        ]);

        if($validation->fail()){
            return Tool::withinOutput(Codes::PARAMS_ERROR,$validation->errors()->all());
        }
        return Tool::withinOutput(Codes::SUCCESS);
    }
}