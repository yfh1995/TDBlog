<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/11/16
 * Time: 13:27
 */

namespace App\Models;


use App\Services\CacheService;
use App\Util\CacheKey;
use App\Util\TablesName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ChannelEvent extends Model {

    protected $table = TablesName::ADMIN_CHANNEL_EVENT;

    /**
     * 获取广播通道、事件缓存
     * @return array
     */
    public static function getChannelEventCache($channel = ''){
        if(!($channelEvent = Cache::get(CacheKey::AdminChannelEvent))){
            $channelEvent = self::updateChannelEventCache();
        }

        return $channel?(isset($channelEvent[$channel])?$channelEvent['channel']:[]):$channelEvent;
    }

    /**
     * 更新广播通道、事件缓存
     * @return array
     */
    public static function updateChannelEventCache(){
        $query = ChannelEvent::orderBy('channel')->orderBy('event')->get()->toArray();
        $channelEvent = [];
        foreach ($query as $one){
            $channelEvent[$one['channel']][] = $one['event'];
        }

        CacheService::refreshPusherChannel(CacheKey::AdminChannelEvent,$channelEvent);
        return $channelEvent;
    }
}