<?php

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        $app_name = \App\Models\Configs::select('value')->where(['key'=>'app_name'])->first();
        return $app_name ? $app_name->value : config('app.name');
    }
}

if (! function_exists('getPermissionsById')) {
    /**
     * 根据用户id获取用户所有权限
     *
     * @return mixed
     */
    function getPermissionsById($id)
    {
        return \App\User::getPermissionsById($id);
    }
}

if (! function_exists('checkHavePermissions')) {
    /**
     * 检查指定用户是否拥有指定权限
     *
     * @return mixed
     */
    function checkHavePermissions($uid, $needSlugs)
    {
        return \App\Models\Permissions::checkHavePermissions($uid, $needSlugs);
    }
}

if (! function_exists('getRolesById')) {
    /**
     * 根据用户id获取用户所有角色
     *
     * @return mixed
     */
    function getRolesById($id)
    {
        return \App\User::getRolesById($id);
    }
}

if (! function_exists('getIntersectionInTwoArray')) {
    /**
     * 获取两个数组的交集数组
     *
     * @return mixed
     */
    function getIntersectionInTwoArray($a,$b)
    {
        return \App\CommonTools::getIntersectionInTwoArray($a,$b);
    }
}

if (! function_exists('multilingual')) {
    /**
     * 获取多语言句子
     *
     * @return mixed
     */
    function multilingual($word)
    {
        return \App\CommonTools::multilingual($word);
    }
}