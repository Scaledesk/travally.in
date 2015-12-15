<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
class RegistrationController extends BaseController
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => bcrypt($data['password']),
        ]);
    }

    public function register()
    {
//        $enabled_registrations = [2];

        //$confirmation_code = str_random(30);


        $data = [
            'name'              => Input::get('name'),
            'email'             => Input::get('email'),
            'password'          => Input::get('password'),
        ];
        if ($this->validator($data)) {
            $user = $this->create($data);
            /*$activation_link = 'localhost:300\\activate\\' . $user->confirmation_code;
            $this->dispatch(new SendRegistrationEmail($user));*/
            return $this->respondSuccess('Registration Successfully');
//            return "Registration Successfull";
        } else {
            return $this->respondValidationError('Validation error');
        }
    }

    /*public function confirm($confirmation_code)
    {
        if (!$confirmation_code) {
            return "error";
        }

        $user = User::whereConfirmationCode($confirmation_code)
            ->first();

        if (!$user) {
            return "error";
        }

        $user->confirmed         = 1;
        $user->confirmation_code = null;
        $user->save();

        $this->dispatch(new SendConfirmationEmail($user));

        return "confirmed";
    }*/
}