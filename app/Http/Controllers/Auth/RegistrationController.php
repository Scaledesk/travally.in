<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
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


        $name = Input::get('name');
        $email = Input::get('email');
        $data = [
            'name'              => Input::get('name'),
            'email'             => Input::get('email'),
            'password'          => Input::get('password'),
        ];
        try {
            if ($this->validator($data)) {
                $user = $this->create($data);
                $user->profiles()->create([
                    'travally_profiles_user_id' => $user->id,
                    'travally_profiles_name' => $data['name']
                ]);
                try{
                set_time_limit(60);
                Mail::send('emails.Welcome',array('name'=>$name), function ($message)use($name,$email) {
                    $message->to($email,$name)->subject('Welcome Message');
                });
                }catch(\Exception $e){
                    return $this->respondWithError($e->getMessage());
                }


                return $this->respondSuccess('Registration Successfully');

//            return "Registration Successfull";
            } else {
                return $this->respondValidationError('Validation error');
            }



        } catch(\Exception $e){
            return $this->respondWithError($e->getMessage());
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