<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','social_auth_provider_access_token','social_auth_provider','social_auth_provider_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function profiles(){
        return $this->hasOne('App\Profile','travally_profiles_user_id');
    }
    public function flightBookingDetails()
    {
        return $this->hasMany('App\FlightBookingDetails', 'user_id');
    }
    public function busBookingDetails()
    {
        return $this->hasMany('App\BusBookingDetails', 'user_id');
    }
    public function cancellationDetails()
    {
        return $this->hasMany('App\CancellationDetails', 'user_id');
    }
    public function transactionDetails()
    {
        return $this->hasMany('App\TransactionDetails', 'user_id');
    }
}
