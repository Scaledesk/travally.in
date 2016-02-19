<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    //
    const TABLE = 'travally_transaction_details';
    const ID = 'travally_transaction_details_id';
    const TYPE = 'travally_transaction_details_type';
    const AMOUNT = 'travally_transaction_details_amount';
    const STATUS = 'travally_transaction_details_status';
    const USER_ID = 'user_id';

    protected $table=self::TABLE;
    protected $primaryKey=self::ID;
    protected $fillable=[self::ID,self::TYPE,self::AMOUNT,self::STATUS,self::USER_ID];
    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
