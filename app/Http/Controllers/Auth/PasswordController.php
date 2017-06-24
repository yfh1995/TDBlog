<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function updatePasswordReset($email){
        $reset = PasswordReset::where('email',$email)->first();
        if(!$reset){
            $reset = new PasswordReset;
            $reset->email = $email;
        }
        $reset->token = $this->createResetPasswordCode($email);
        $reset->created_at = date('Y-m-d H:i:s');
        return $reset->save()?$reset->token:false;
    }

    protected function createResetPasswordCode($str){
        return md5(time().$str);
    }
}
