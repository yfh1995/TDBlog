<?php

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name
     *
     * @return mixed
     */
    function app_name()
    {
        $app_name = \App\Models\Base\Configs::select('value')->where(['key'=>'app_name'])->first();
        return $app_name ? $app_name->value : config('app.name');
    }
}

if (! function_exists('permissionsById')) {
    /**
     * 根据用户id获取用户所有权限
     *
     * @return mixed
     */
    function permissionsById($id)
    {
        return \App\Models\Admin\Permissions::getPermissionsById($id);
    }
}