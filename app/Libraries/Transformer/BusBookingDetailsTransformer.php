<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 20/01/16
 * Time: 01:47 PM
 */
namespace app\Libraries\Transformer;
use App\BusBookingDetails;
use App\Libraries\Transformer\Transformer;
use Illuminate\Support\Facades\Input;


class BusBookingDetailsTransformer extends Transformer
{
    public function transform($data){
        return [
            'source'=>$data[BusBookingDetails::SOURCE],
            'destination'=>$data[BusBookingDetails::DESTINATION],
            'departure_date'=>$data[BusBookingDetails::DEPARTURE_DATE],
            'ticket_no'=>$data[BusBookingDetails::TICKET_NO],
            'description'=>$data[BusBookingDetails::DESCRIPTION],
            'travel_operator'=>$data[BusBookingDetails::TRAVEL_OPERATOR],
            'travel_operator_pnr'=>$data[BusBookingDetails::TRAVEL_OPERATOR_PNR],
        ];
    }
    public function requestAdaptor(){
        return [

            BusBookingDetails::TICKET_NO => Input::get('ticket_no',''),
            BusBookingDetails::STATUS => Input::get('status',''),
            BusBookingDetails::TRAVEL_OPERATOR => Input::get('travel_operator',''),
            BusBookingDetails::TRAVEL_OPERATOR_PNR => Input::get('travel_operator_pnr',''),
            BusBookingDetails::DESCRIPTION => Input::get('description',''),
            BusBookingDetails::SOURCE => Input::get('source',''),
            BusBookingDetails::DESTINATION => Input::get('destination',''),
            BusBookingDetails::DEPARTURE_DATE => Input::get('departure_date',''),

        ];
    }
}

