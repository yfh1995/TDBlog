<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/27
 * Time: 17:01
 */

namespace App\Http\Controllers\Api;


use App\Events\Login;
use App\Http\Controllers\Controller;
use App\User;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    /**
     * @SWG\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="用户登录接口",
     *     description="",
     *     operationId="base-auth-login",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="email",
     *         description="邮箱",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Parameter(
     *         name="sequence",
     *         description="序列号",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Parameter(
     *         name="voucher",
     *         description="登录凭证",
     *         required=true,
     *         type="string",
     *         format="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="请求成功",
     *         @SWG\Schema(ref="#/definitions/login")
     *     )
     * )
     */
    public function login(Request $request){
        $res = $this->loginValidation($request);
        if($res !== true) return $res;
        $params = $request->all();

        //验证用户登录凭证
        $isReal = Tool::checkSequenceAndVoucher($params['sequence'],$params['voucher'],$params['email']);
        if(!$isReal) return Tool::apiOutput(Codes::LOGIN_VOUCHER_EXPIRED_OR_ERROR);

        $user = User::where('email',$params['email'])->first(['username','name','email','phone','avatar']);
        if(isset($user->id) && $user = Auth::loginUsingId($user->id)){

            //触发用户登录事件
            Event::fire(new Login($user));

            $user['token'] = $user->createToken(app_name())->accessToken;
            return Tool::apiOutput(Codes::SUCCESS,$user);
        }else{
            //打印错误日志
            Log::error('用户凭证验证成功，登录失败，用户id：',isset($user->id)?$user->id:'');
            return Tool::apiOutput(Codes::LOGIN_FAIL);
        }
    }

    /**
     * 登录参数验证
     * @param $request
     * @return bool|string
     */
    private function loginValidation($request){

        $validation = Validator::make($request->all(),[
            'email'     =>  'required|email|max:'.$this->configs['email_min_length'],
            'sequence'  =>  'required|min:'.config('TDConfig.seqLen').'|max:'.config('TDConfig.seqLen'),
            'voucher'   =>  'required'
        ],[
            'email.required'    =>  multilingual('prompt.email').multilingual('prompt.valRequired'),
            'email.email'       =>  multilingual('prompt.email').multilingual('prompt.valEmail'),
            'email.max'         =>  multilingual('prompt.email').multilingual('prompt.valMax').$this->configs['email_min_length'],
            'sequence.required' =>  multilingual('prompt.sequence').multilingual('prompt.valRequired'),
            'sequence.min'      =>  multilingual('prompt.sequence').multilingual('prompt.valMin').config('TDConfig.seqLen'),
            'sequence.max'      =>  multilingual('prompt.sequence').multilingual('prompt.valMax').config('TDConfig.seqLen'),
            'voucher.required'  =>  multilingual('prompt.voucher').multilingual('prompt.valRequired')
        ]);

        if($validation->fails()){
            return Tool::apiOutput(Codes::PARAMS_ERROR,$validation->errors()->all());
        }
        return true;
    }

    /**
     * @SWG\Definition(
     *     definition="login",
     *     type="object",
     *     required={"username","name","email","phone","avatar","token"},
     *     @SWG\Property(
     *         property="username",
     *         type="string"
     *     ),
     *     @SWG\Property(
     *         property="name",
     *         type="string",
     *         description="昵称"
     *     ),
     *     @SWG\Property(
     *         property="username",
     *         type="string",
     *         description="真实名字"
     *     ),
     *     @SWG\Property(
     *         property="email",
     *         type="string",
     *         description="邮箱"
     *     ),
     *     @SWG\Property(
     *         property="phone",
     *         type="string",
     *         description="电话"
     *     ),
     *     @SWG\Property(
     *         property="avatar",
     *         type="string",
     *         description="头像"
     *     ),
     *     @SWG\Property(
     *         property="token",
     *         type="string",
     *         description="令牌"
     *     )
     * )
     */

}