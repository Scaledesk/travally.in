<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 19/02/16
 * Time: 01:47 PM
 */
namespace app\Libraries\Transformer;
use App\TransactionDetails;
use App\Libraries\Transformer\Transformer;
use Illuminate\Support\Facades\Input;


class TransactionDetailsTransformer extends Transformer
{
    public function transform($data){
        return [
            'type'=>$data[TransactionDetails::TYPE],
            'Amount'=>$data[TransactionDetails::AMOUNT],
            'status'=>$data[TransactionDetails::STATUS]
        ];
    }
    public function requestAdaptor(){
        return [
            TransactionDetails::TYPE => Input::get('type',''),
            TransactionDetails::AMOUNT => Input::get('amount',''),
            TransactionDetails::STATUS => Input::get('status',''),
        ];
    }
}