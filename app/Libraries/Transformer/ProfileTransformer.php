<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 11/12/15
 * Time: 5:11 PM
 */

namespace app\Libraries\Transformer;
use App\Profile;
use App\Libraries\Transformer\Transformer;
use Illuminate\Support\Facades\Input;


class ProfileTransformer extends Transformer
{
    public function transform($data){
        return [
            'Name'=>$data[Profile::NAME],
            'Address'=>$data[Profile::ADDRESS],
            'DOB'=>$data[Profile::DOB],
            'Image'=>$data[Profile::IMAGE],
        ];
    }
    public function requestAdaptor(){
        return [
            Profile::NAME => Input::get('name',''),
            Profile::ADDRESS => Input::get('address',''),
            Profile::DOB => Input::get('dob',''),
            Profile::IMAGE => Input::get('image',''),
        ];
    }
}