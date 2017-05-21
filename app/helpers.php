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