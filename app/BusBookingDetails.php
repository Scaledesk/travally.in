<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusBookingDetails extends Model
{
    //
    const TABLE = 'travally_user_bus_booking_details';
    const ID = 'travally_user_bus_booking_details_id';
    const TICKET_NO = 'travally_user_bus_booking_details_ticket_no';
    const STATUS = 'travally_user_bus_booking_details_status';
    const TRAVEL_OPERATOR = 'travally_user_bus_booking_details_travel_operator';
    const TRAVEL_OPERATOR_PNR = 'travally_user_bus_booking_details_travel_operator_pnr';
    const DESCRIPTION ='travally_user_bus_booking_details_description';
    const SOURCE = 'travally_user_bus_booking_details_source';
    const DESTINATION = 'travally_user_bus_booking_details_destination';
    const DEPARTURE_DATE = 'travally_user_bus_booking_details_departure_date';
    const USER_ID = 'user_id';

    protected $table=self::TABLE;
    protected $primaryKey=self::ID;
    protected $fillable=[self::TICKET_NO,self::SOURCE,self::STATUS,self::TRAVEL_OPERATOR,self::TRAVEL_OPERATOR_PNR,self::DESCRIPTION,self::DESTINATION,self::DEPARTURE_DATE,self::USER_ID];
    public $timestamps=true;
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}