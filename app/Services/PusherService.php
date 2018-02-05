<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/11/15
 * Time: 17:53
 */

namespace App\Services;

use App\Models\ChannelEvent;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * 广播服务
 * Class Pusher
 * @package App\Services
 */
class PusherService
{
    /**
     * 推送广播信息
     * @param $request
     * @return array
     */
    public function trigger($request){

        $res = $this->triggerValidation($request);
        if($res['code'] != Codes::SUCCESS){
            return $res;
        }

        $params = $request->all();

        $res = Event::fire(new \App\Events\Pusher($params['channel'],$params['event'],isset($params['data'])?$params['data']:''));
        foreach ($res as $one){
            if($one != Codes::SUCCESS){
                return $one;
            }
        }

        return Tool::withinOutput(Codes::SUCCESS);
    }

    /**
     * 验证推送参数合法性
     * @param $request
     * @return array
     */
    private function triggerValidation($request){

        //获取通道、动作信息
        $chaEve = ChannelEvent::getChannelEventCache();

        $validation = Validator::make($request->all(),[
            'channel'   =>  ['required',Rule::in(array_keys($chaEve))],
            'event'     =>  ['required',Rule::in($chaEve[$request->get('channel')])],
        ],[
            'channel.required'  =>  multilingual('prompt.channel').multilingual('prompt.valRequired'),
            'channel.in'        =>  multilingual('prompt.channel').multilingual('prompt.inVal'),
            'event.required'    =>  multilingual('prompt.event').multilingual('prompt.valRequired'),
            'event.in'          =>  multilingual('prompt.event').multilingual('prompt.inVal'),
        ]);

        if($validation->fails()){
            return Tool::withinOutput(Codes::PARAMS_ERROR,$validation->errors()->all());
        }
        return Tool::withinOutput(Codes::SUCCESS);
    }
}