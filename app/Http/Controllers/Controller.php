<?php

namespace App\Http\Controllers;

use App\Models\Configs;
use App\Util\CacheKey;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use PhpParser\Builder\Class_;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const LS = 'ls';

    protected $configs;

    /**
     * 获取配置参数
     * Controller constructor.
     */
    public function __construct(){

        $this->configs = $this->getConfigs();
    }

    public function getConfigs(){
        $configs = Configs::getConfigs();;
        $res = [];
        foreach ($configs as $v){
            $res[$v['key']] = $v['value'];
        }
        return $res;
    }

    public function test(){

    }
}
