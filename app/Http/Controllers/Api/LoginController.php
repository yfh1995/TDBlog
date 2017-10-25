<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/25
 * Time: 15:28
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller {

    public function login(Request $request){
        if(!$this->loginValidation($request)) return;

        if(Auth::validate([$request->get('email'),$request->get('password')])){

        }else{
            return Tool::apiOutput(Codes::NAME_OR_PASSWORD_ERROR);
        }
    }

    /**
     * 登录参数验证
     * @param $request
     * @return bool
     */
    private function loginValidation($request){

        $validator = Validator::make($request->all(), [
            'email'     =>  'required|email|max:'.$this->configs['email_length'],
            'password'  =>  'required|min:'.$this->configs['password_min_length'].'|max:'.$this->configs['password_max_length'],
            'backUrl'
        ],[
            'email.required'
        ]);

        if ($validator->fails()) {
            Tool::apiOutput(Codes::PARAMS_ERROR,$validator->errors()->all());
            return false;
        }
        return true;
    }

}