<?php
/**
 * Created by PhpStorm.
 * User: yfh69
 * Date: 2017/9/27
 * Time: 13:20
 */

namespace App\Http\Middleware;

use App\Facade\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermissions
{
    /**
     * 判断权限是否足够
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $needSlugs
     * @return mixed
     */
    public function handle($request, Closure $next, $needSlugs = '')
    {
        $needSlugs = explode('|',$needSlugs);

        if(Auth::guard(config('admin.prefix'))->guest()) return redirect()->guest('login');
        $haveSlugs = User::permissions();

        foreach ($needSlugs as $v){
            if(!isset($haveSlugs[$v])) {
                return back()->withErrors(['title'=> multilingual('prompt.notice'), 'message'=>multilingual('prompt.lack_permission:') . $v]);
            }
        }
        return $next($request);
    }
}