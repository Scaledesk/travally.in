<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    //
    const TABLE = 'travally_transaction_details';
    const ID = 'travally_transaction_details_id';
    const TYPE = 'travally_transaction_details_type';
    const TXN_ID = 'travally_transaction_details_txn_id';
    const AMOUNT = 'travally_transaction_details_amount';
    const STATUS = 'travally_transaction_details_status';
    const BOOKING_REQUEST = 'travally_transaction_details_booking_request';

    const NET_DEBIT_AMOUNT =  'travally_transaction_details_net_amount_debit';
    const PAYMENT_SOURCE = 'travally_transaction_details_payment_source';
    const PAYMENT_MODE = 'travally_transaction_details_payment_mode';
    const CARD_TYPE = 'travally_transaction_details_card_type';
    const CARD_NUM = 'travally_transaction_details_card_num';
    const BANK_REF_NUM = 'travally_transaction_details_bank_ref_number';
    const BANK_CODE = 'travally_transaction_details_bank_code';

    const USER_ID = 'user_id';

    protected $table=self::TABLE;
    protected $primaryKey=self::ID;
    protected $fillable=[self::ID,self::TYPE,self::AMOUNT,self::TXN_ID,self::STATUS,self::USER_ID,
        self::BOOKING_REQUEST, self::NET_DEBIT_AMOUNT,self::PAYMENT_SOURCE,self::PAYMENT_MODE,self::CARD_NUM,self::CARD_TYPE,
    self::BANK_CODE,self::BANK_REF_NUM];
    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
