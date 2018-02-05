<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/31
 * Time: 13:50
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Configs;
use App\Util\Codes;
use App\Util\Tool;

class ToolController extends Controller {

    /**
     * @SWG\Post(
     *     path="/api/tool/updateBackendConfigsCache",
     *     tags={"Tool"},
     *     summary="强制更新后台configs缓存",
     *     description="",
     *     operationId="base-tool-login",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="请求成功"
     *     )
     * )
     */
    public function updateBackendConfigsCache(){
        Configs::updateConfigsCache();
        return Tool::apiOutput(Codes::SUCCESS);
    }

}