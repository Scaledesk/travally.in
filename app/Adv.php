<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adv extends Model
{
    //

    protected $table=self::TABLE;
    protected $primaryKey=self::ID;
    protected $fillable=[self::IMG_URL,self::URL,self::DESC,self::LOCATION];
    public $timestamps=true;
    // define constants
    const TABLE = 'travally_advs';
    const ID = 'travally_advs_id';
    const IMG_URL = 'travally_advs_img_url';
    const URL = 'travally_advs_url';
    const DESC = 'travally_advs_desc';
    const LOCATION = 'travally_advs_location';
}
