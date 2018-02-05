<?php
/**
 * Created by PhpStorm.
 * User: fuhao
 * Date: 2017/5/21
 * Time: 16:16
 */

namespace App\Util;

/**
 * 设置所有用到的cache key，避免冲突
 * Class CacheKey
 * @package App\Util
 */
class CacheKey{

    //=================================常驻缓存数据键值=======================================
    //=================================常驻缓存数据键值=======================================
    //=================================常驻缓存数据键值=======================================

    //常驻的数据表缓存，处理分散于各模型

    const AdminTableVersion = 'admin_table_version';                    //表版本表
    const AdminConfig = 'admin_config';                                 //配置表
    const AdminMenu = 'admin_menu';                                     //菜单表
    const AdminModules = 'admin_modules';                               //模块表
    const AdminResource = 'admin_resource';                             //资源表
    const AdminChannelEvent = 'admin_channel_event';                    //广播渠道表


    ////常驻的非表数据缓存，处理集中于CacheService，前缀为scattered



    //=================================非常驻缓存数据键值=======================================
    //=================================非常驻缓存数据键值=======================================
    //=================================非常驻缓存数据键值=======================================

    //非常驻数据缓存，处理集中于服务CacheService，前缀为temporary


    //邮件缓存，处理集中于服务EmailService

    const EmailRegister = 'temporary_email_register';


    //验证码缓存，处理集中于服务VerificationCodeService

    const CodeRegister = 'temporary_code_register';

}