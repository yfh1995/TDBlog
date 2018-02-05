<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/11/15
 * Time: 18:18
 */

namespace App\Services;


use App\Util\CacheKey;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Support\Facades\Cache;

/**
 * 缓存控制中心
 *
 * Class Cache
 * @package App\Services
 */
class CacheService
{
    const SCATTERED = 'scattered';

    const TEMPORARY = 'temporary';

    /**
     * 批量刷新缓存
     * @param array $params 需要刷新的缓存key-params数组
     * @return array
     */
    public function refreshCache($params = []){
        if(!count($params)){
            return Tool::withinOutput(Codes::SUCCESS);
        }

        $data = [];
        foreach ($params as $key=>$param){
            //检查方法是否存在及调用
            if(!is_callable($this,$key)){
                $data[$key] = Codes::FUNCTION_NOT_EXISTS;
                continue;
            }

            $data[$key] = call_user_func_array([$this,$key],$param);
        }
        return Tool::withinOutput(Codes::SUCCESS,$data);
    }

    /**
     * 批量获取缓存
     * @param array $keys 需要获取的缓存key数组，为空则获取所有此类缓存
     * @return array
     */
    public function getCache($keys = []){
        if(!count($keys)){
            $keys = Tool::getClassConstants(new CacheKey());
        }

        $data = [];
        foreach ($keys as $key){
            $data[$key] = Cache::get($key);
        }
        return Tool::withinOutput(Codes::SUCCESS,$data);
    }


    /**
     * 刷新推送通道信息
     * @param $key
     * @param $data
     * @param int $time
     */
    public static function refreshPusherChannel($key,$data,$time = 0){
        CacheService::unifiedRefresh($key,$data,$time);
    }

    /**
     * 刷新常驻缓存
     * @param $key
     * @param $data
     * @param int $time
     */
    public static function refreshVersionTable($key,$data,$time = 0){
        CacheService::unifiedRefresh($key,$data,$time);
    }

    /**
     * 刷新邮件发送周期缓存
     * @param $key
     * @param $time
     */
    public static function refreshEmailCycle($key,$time){
        CacheService::unifiedRefresh($key,true,$time);
    }

    /**
     * 常驻缓存统一刷新
     * @param $key
     * @param $data
     * @param int $time
     */
    private static function unifiedRefresh($key,$data,$time = 0){
        if($time == 0){
            Cache::forever($key,$data);
        }else{
            Cache::put($key,$data,$time);
        }
    }

}