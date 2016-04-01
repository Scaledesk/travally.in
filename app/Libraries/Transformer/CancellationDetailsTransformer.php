<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 20/01/16
 * Time: 01:47 PM
 */
namespace app\Libraries\Transformer;
use App\CancellationDetails;
use App\Libraries\Transformer\Transformer;
use Illuminate\Support\Facades\Input;


class CancellationDetailsTransformer extends Transformer
{
    public function transform($data){
        return [
            'id'=>$data[CancellationDetails::ID],
            'status'=>$data[CancellationDetails::STATUS],
            'type'=>$data[CancellationDetails::TYPE],
            'cancellation_id'=>$data[CancellationDetails::CANCELLATION_ID],
            'cancellation_tax_no'=>$data[CancellationDetails::CANCELLATION_TAX_NO],
            'cancellation_charge'=>$data[CancellationDetails::CANCELLATION_CHARGE],
            'refund_amount'=>$data[CancellationDetails::REFUND_AMOUNT]
        ];
    }

    public function requestAdaptor(){
        return [
            CancellationDetails::STATUS => Input::get('status',''),
            CancellationDetails::TYPE => Input::get('type',''),
            CancellationDetails::CANCELLATION_ID => Input::get('cancellation_id',''),
            CancellationDetails::CANCELLATION_TAX_NO => Input::get('cancellation_tax_no',''),
            CancellationDetails::CANCELLATION_CHARGE => Input::get('cancellation_charge',''),
            CancellationDetails::REFUND_AMOUNT => Input::get('refund_amount',''),
        ];
    }
}

