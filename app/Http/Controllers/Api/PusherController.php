<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/11/15
 * Time: 17:46
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\PusherService;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PusherController extends Controller
{
    /**
     * 推送信息
     * @param Request $request
     * @param PusherService $pusher
     * @return string
     */
    public function trigger(Request $request,PusherService $pusher){
        $code = $pusher->trigger($request);
        return Tool::apiOutput($code['code'],$code['data']);
    }
}