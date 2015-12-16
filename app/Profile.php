<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //

    const TABLE = 'travally_profiles';
    const USER_ID = 'travally_profiles_user_id';
    const NAME = 'travally_profiles_name';
    const ADDRESS = 'travally_profiles_address';
    const DOB = 'travally_profiles_dob';
    const IMAGE = 'travally_profiles_image';
    protected $table = self::TABLE;
    protected $fillable = [self::NAME, self::USER_ID, self::ADDRESS, self::DOB, self::IMAGE];
    public function user()
    {
        return $this->belongsTo('App\User', 'travally_profiles_user_id');
    }
}
