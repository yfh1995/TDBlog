<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/27
 * Time: 17:01
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\User;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {

    public function login(Request $request){
        if(!$this->loginValidation($request)) return;
        $params = $request->all();

        $user = User::where('email',$params['email'])->find();
        if(isset($user->id) && $user = Auth::loginUsingId($user->id)){

        }else{

        }
    }

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
}