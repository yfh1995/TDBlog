<?php

namespace App\Listeners;

use App\Events\Pusher;
use App\Util\Codes;
use App\Util\Tool;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PusherListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 发送广播信息
     *
     * @param Pusher $event
     *
     * @return array|bool
     */
    public function handle(Pusher $event)
    {
        $config = config('broadcasting.connections.pusher');
        $pusher = new \Pusher\Pusher($config['key'],$config['secret'],$config['app_id'],$config['options']);
        $res = $pusher->trigger($event->channel, $event->event, $event->data);
        if($res == true) return Tool::withinOutput(Codes::SUCCESS);
        else return Tool::withinOutput(Codes::FAIL,$res);
    }
}
