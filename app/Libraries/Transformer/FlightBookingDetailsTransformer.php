<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 20/01/16
 * Time: 01:47 PM
 */
namespace app\Libraries\Transformer;
use App\FlightBookingDetails;
use App\Libraries\Transformer\Transformer;
use Illuminate\Support\Facades\Input;


class FlightBookingDetailsTransformer extends Transformer
{
    public function transform($data){
        return [
            'source'=>$data[FlightBookingDetails::SOURCE],
            'destination'=>$data[FlightBookingDetails::DESTINATION],
            'departure_date'=>$data[FlightBookingDetails::DEPARTURE_DATE],
            'booking_id'=>$data[FlightBookingDetails::BOOKING_ID],
            'pnr'=>$data[FlightBookingDetails::PNR],
            'airline'=>$data[FlightBookingDetails::AIRLINE],
            'payment_reference_no'=>$data[FlightBookingDetails::PAYMENT_REFERENCE_NO],
        ];
    }
    public function requestAdaptor(){
        return [
            FlightBookingDetails::PNR => Input::get('pnr',''),
            FlightBookingDetails::AIRLINE => Input::get('airline',''),
            FlightBookingDetails::BOOKING_ID => Input::get('booking_id',''),
            FlightBookingDetails::SSR_DENIED => Input::get('ssr_denied',''),
            FlightBookingDetails::SSR_MESSAGE => Input::get('ssr_message',''),
            FlightBookingDetails::SSR_PROD_TYPE => Input::get('ssr_prod_type',''),
            FlightBookingDetails::CONFIRMATION_NO => Input::get('confirmation_no',''),
            FlightBookingDetails::PAYMENT_REFERENCE_NO => Input::get('payment_reference_no',''),
            FlightBookingDetails::REF_ID => Input::get('ref_id',''),
            FlightBookingDetails::STATUS_CODE => Input::get('status_code',''),
            FlightBookingDetails::STATUS_DESCRIPTION => Input::get('status_description',''),
            FlightBookingDetails::STATUS_CATEGORY => Input::get('status_category',''),
            FlightBookingDetails::SOURCE => Input::get('source',''),
            FlightBookingDetails::DESTINATION => Input::get('destination',''),
            FlightBookingDetails::DEPARTURE_DATE => Input::get('departure_date',''),
            FlightBookingDetails::USER_ID => Input::get('user_id','')
        ];
    }
}