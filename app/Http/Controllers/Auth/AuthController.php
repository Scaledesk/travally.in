<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
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
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }


    public function verify($username, $password)
    {
        $credentials = [
            'email'     => $username,
            'password'  => $password
            //'confirmed' => '1'
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

    /**
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function google(Request $request)
    {

        if ($request->has('redirectUri')) {
            config()->set("services.google.redirect", $request->get('redirectUri'));
        }
        $provider = Socialite::driver('google');
        $provider->stateless();

        $profile      = $provider->user();
        $email        = $profile->email;
        $name         = $profile->name;
        $google_token = $profile->token;
        $google_id    = $profile->id;

        $user = User::where('email', $email)
            ->first();

        if (is_null($user)) {
            $data = [
                'email'                             => $email,
                'name'                              => $name,
                'password'                          => null,
                'social_auth_provider_access_token' => $google_token,
                'social_auth_provider'              => 'google',
                'social_auth_provider_id'           => $google_id
            ];
            $user = User::create($data);

            $response = Response::json($user);
            return $response;
        } else {
            $user->social_auth_provider_access_token = $profile->token;
            $user->social_auth_provider_id           = $profile->id;
            $user->social_auth_provider              = 'google';
            $user->save();
            $response = Response::json($user);
            return $response;
        }

    }

    public function verify_social($social_auth_provider_id, $social_auth_provider_access_token)
    {
        $user = User::where('social_auth_provider_id', $social_auth_provider_id)
            ->where('social_auth_provider_access_token', $social_auth_provider_access_token)
            ->first();

        if ($user) {
            return $user->id;
        }

        return false;
    }
}
