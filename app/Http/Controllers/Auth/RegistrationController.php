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

    /**
     * function for new user registration
     * @return mixed
     * @Author Javed
     */

    public function register()
    {
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


    /**
     * function for sending password reset link
     * @return mixed
     * @Author Javed
     */

    public function forgotPassword(){
        $email=Input::get('email');
        if($email==''){
            return $this->respondValidationError('Email not provided, try email=<your email>');
        }
//        $code='';
        // check if email exist in database
        if(User::where('email','=',$email)->first(['id'])){
            $code= str_random(30); // make random code
            User::where('email','=',$email)->update(['forgot_password_code'=>$code]); //code store in database
        }else{
            return $this->respondNotFound('Email does not match any records'); // error message on email not found
        }
        try {
            set_time_limit(60); //increase the timeout of php to send mail
            Mail::send('emails.forgotPassword', array('forgot_password_code' => $code), function ($message) {
                $message->to(Input::get('email'))
                    ->subject('Forgot Password');
            });
        }catch(\Exception $e){
            return $this->respondWithError($e->getMessage());
        }
        return $this->respondSuccess('Success! Reset password link sent');
    }

    /**
     * function for reset password
     * @return mixed
     * @Author Javed
     */
    public function resetPassword(){
        $str='';
        $code=Input::get('forgot_password_code','');
        $password=Input::get('password','');
        $password_confirmation=Input::get('password_confirmation','');
        $check_for_password_match=true;
        if($code==''){
            $str.='Code not provided, try forgot_password_code=<your code>';
        }
        if($password==''){
            $str.='<br/>password not provided, try password=<your password><br/>';
            $check_for_password_match=false;
        }
        if($password_confirmation==''){
            $str.='<br/>password_confirmation not provided, try password_confirmation=<your confirm password><br/>';
            $check_for_password_match=false;
        }
        if($check_for_password_match){
            if($password!=$password_confirmation){
                $str.='<br/>password and password_confirmation do not match<br/>';
            }
        }

        if($str!=''){
            return $this->respondValidationError($str);
        }
        try {
            if(User::where('forgot_password_code', '=', $code)->update([
                'password' => bcrypt($password),
                'forgot_password_code' => NULL
            ])){
                return $this->respondSuccess('successfully reset password');
            }
            else{
                return $this->respondSuccess('this link expire for resend password reset link ');
            }
        }catch(\Exception $e){
            return $this->respondWithError($e->getMessage());
        }
    }
}