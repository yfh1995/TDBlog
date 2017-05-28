<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/28
 * Time: 15:26
 */

namespace App\Http\Requests\Auth;


use App\Http\Requests\Request;

class RegisterUserRequest extends Request{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required'        =>  '请输入邮箱',
            'email.email'           =>  '邮箱格式错误',
            'password.required'     =>  '请输入密码',
            'password.min'          =>  '密码不能少于6个字符',
        ];
    }
}