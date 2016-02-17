<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlightBookingDetails extends Model
{
    /**
     *
     */
    // define constants

    const TABLE = 'travally_user_flight_booking_details';
    const ID = 'travally_user_flight_booking_details_id';
    const PNR = 'travally_user_flight_booking_details_pnr';
    const AIRLINE = 'travally_user_flight_booking_details_airline';
    const BOOKING_ID = 'travally_user_flight_booking_details_booking_id';
    const SSR_DENIED = 'travally_user_flight_booking_details_ssr_denied';
    const SSR_MESSAGE = 'travally_user_flight_booking_details_ssr_message';
    const SSR_PROD_TYPE = 'travally_user_flight_booking_details_prod_type';
    const CONFIRMATION_NO = 'travally_user_flight_booking_details_confirmation_no';
    const PAYMENT_REFERENCE_NO = 'travally_user_flight_booking_details_payment_reference_no';
    const REF_ID = 'travally_user_flight_booking_details_ref_id';
    const STATUS_CODE = 'travally_user_flight_booking_details_status_code';
    const STATUS_DESCRIPTION = 'travally_user_flight_booking_details_status_description';
    const STATUS_CATEGORY = 'travally_user_flight_booking_details_status_category';
    const SOURCE = 'travally_user_flight_booking_details_source';
    const SOURCE_VALUE = 'travally_user_flight_booking_details_source_value';
    const DESTINATION = 'travally_user_flight_booking_details_destination';
    const DEPARTURE_DATE = 'travally_user_flight_booking_details_departure_date';
    const USER_ID = 'user_id';

    protected $table=self::TABLE;
    protected $primaryKey=self::ID;
    protected $fillable=[self::PNR,self::AIRLINE,self::BOOKING_ID,self::SSR_DENIED,
        self::SSR_MESSAGE,self::SSR_PROD_TYPE,self::CONFIRMATION_NO,self::PAYMENT_REFERENCE_NO,
        self::REF_ID,self::STATUS_CODE,self::STATUS_DESCRIPTION,self::STATUS_CATEGORY,
        self::SOURCE,self::DESTINATION,self::DEPARTURE_DATE,self::USER_ID,self::SOURCE_VALUE];
    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }



}
