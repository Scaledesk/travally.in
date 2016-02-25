<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancellationDetails extends Model
{
    //
    const TABLE = 'travally_cancellation_details';
    const ID = 'travally_cancellation_details_id';
    const TYPE = 'travally_cancellation_details_type';
    const STATUS = 'travally_cancellation_details_status';
    const CANCELLATION_ID = 'travally_cancellation_details_cancellation_id';
    const CANCELLATION_TAX_NO = 'travally_cancellation_details_cancellation_tax_no';
    const CANCELLATION_CHARGE = 'travally_cancellation_details_cancellation_charge';
    const REFUND_AMOUNT = 'travally_cancellation_details_refund_amount';
    const USER_ID = 'user_id';
    protected $table=self::TABLE;
    protected $primaryKey=self::ID;
    protected $fillable=[self::TYPE,self::STATUS,self::CANCELLATION_ID,self::CANCELLATION_TAX_NO,self::CANCELLATION_CHARGE,self::REFUND_AMOUNT,self::USER_ID];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }



}
