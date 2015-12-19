<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use App\User;

class PasswordController extends BaseController
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
        $this->middleware('oauth');
    }

    /**
     * function for change password
     * @Author Javed
     */


    public function changePassword(){
        $old_password = Input::get('old_password');
        $new_password = Input::get('new_password');
        $user_id=Authorizer::getResourceOwnerId(); // the token user_id
        $user=User::find($user_id);// get the user data from database
        try{
            if(Hash::check($old_password, $user->password)){
                $user->password=$new_password;
                $user->save();
                return $this->respondSuccess('you have successfully updated your password');
            }
            else{
                return $this->respondValidationError('old passwword does not match');
            }
        }catch (\Exception $e){
            return $this->respondValidationError($e->getMessage());
        }
    }

}
