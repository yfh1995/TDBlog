<?php

namespace App\Http\Controllers\Auth;

use App\Models\Base\RoleUser;
use App\Models\Base\UserInfo;
use App\User;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/';

    /**
     * users表前缀
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admin_users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(!isset($data['name'])) $data['name'] = substr($data['email'],0,strrpos($data['email'],'@'));

        DB::beginTransaction();

        $user = $this->createUser($data);
        if($user === false) return false;

        //创建角色表信息
        $roleUser = $this->createRoleUser($user);

        //创建基础信息表信息
        $userInfo = $this->createUserInfo($data,$user);

        return $user;
    }

    public function createUser($data){

        $userDate = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activation_code' => $this->createActivationCode($data['email'])
        ];
        if(!config('tdblog.email_verification')) $userDate['activated'] = 1;

        return User::create($userDate);
    }

    public function createRoleUser($user){
        return RoleUser::create([
            'role_id'   =>  config('tdblog.Roles.User'),
            'user_id'   =>  $user->id
        ]);
    }

    public function createUserInfo($data,$user){
        return UserInfo::create([
            'id'    =>  $user->id,
            'name'  =>  $data['name'],
            'avatar'    =>  config('tdblog.avatar'),
            'banner'    =>  config('tdblog.banner'),
        ]);
    }

    protected function createActivationCode($str){
        return md5(time().$str);
    }
}
