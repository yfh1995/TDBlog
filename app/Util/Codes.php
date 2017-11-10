<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/10/25
 * Time: 15:44
 */

namespace App\Util;


class Codes {

    const

        SUCCESS                 =   0,          //请求成功
        FAIL                    =   1,          //请求失败

        //==================公共错误=====================

        PARAMS_ERROR                        =   100001,         //参数错误Invalid
        NAME_OR_PASSWORD_ERROR              =   100002,         //用户不存在或者密码错误
        LOGIN_VOUCHER_EXPIRED_OR_ERROR      =   100003,         //登录凭证验证失败
        LOGIN_FAIL                          =   100004,         //登录失败
        CANNOT_SEND_EMAIL_WITHIN_TIME       =   100005,         //单位时间内不能多次发送邮件
        VERIFICATION_CODE_INVALID_OR_ERROR  =   100006          //验证码失效或错误，请重试获取验证码
    ;

    public static $MSG = [

        self::SUCCESS           =>  '请求成功',
        self::FAIL              =>  '请求失败',

        self::PARAMS_ERROR                          =>  '参数错误',
        self::NAME_OR_PASSWORD_ERROR                =>  '用户不存在或者密码错误',
        self::LOGIN_VOUCHER_EXPIRED_OR_ERROR        =>  '登录凭证验证失败',
        self::LOGIN_FAIL                            =>  '登录失败',
        self::CANNOT_SEND_EMAIL_WITHIN_TIME         =>  '单位时间内不能多次发送邮件',
        self::VERIFICATION_CODE_INVALID_OR_ERROR    =>  '验证码失效或错误，请重试获取验证码',
    ];
}