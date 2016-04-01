<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 17/02/16
 * Time: 12:38 PM
 */
namespace app\Libraries\Transformer;
use App\HotelBookingDetails;
use App\Libraries\Transformer\Transformer;
use Illuminate\Support\Facades\Input;

class HotelBookingDetailsTransformer extends Transformer
{
    public function transform($data){
        return [
            'city'=>$data[HotelBookingDetails::CITY]
        ];
    }
    public function requestAdaptor(){
        return [

            HotelBookingDetails::CITY => Input::get('city',''),
        ];
    }
}

