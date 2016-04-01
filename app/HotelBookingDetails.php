<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelBookingDetails extends Model
{
    //

    const TABLE = 'travally_user_hotel_booking_details';
    const ID = 'travally_user_hotel_booking_details_id';

    /*const TICKET_NO = 'travally_user_bus_booking_details_ticket_no';
    const STATUS = 'travally_user_bus_booking_details_status';
    const TRAVEL_OPERATOR = 'travally_user_bus_booking_details_travel_operator';
    const TRAVEL_OPERATOR_PNR = 'travally_user_bus_booking_details_travel_operator_pnr';
    const DESCRIPTION ='travally_user_bus_booking_details_description';
    const SOURCE = 'travally_user_bus_booking_details_source';
    const DESTINATION = 'travally_user_bus_booking_details_destination';
    const DEPARTURE_DATE = 'travally_user_bus_booking_details_departure_date';*/

    const USER_ID = 'user_id';
    protected $table=self::TABLE;
    protected $primaryKey=self::ID;

    protected $fillable=[self::USER_ID];

    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
