<?php

namespace App\Http\Controllers;

use App\Models\Base\Configs;
use App\Util\CacheKey;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController {
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected $configs;

    public function __construct(){

        if(! $this->configs = Cache::get(CacheKey::BaseConfig)){
            $this->configs = Configs::updateConfigsCache();
        }
    }

    public function getBaseConfigs(){
        $configs = Configs::where('status',Configs::STATUS_OPEN)->get();
        return $configs->toArray();
    }
}
