<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 11/12/15
 * Time: 5:11 PM
 */

namespace app\libraries\transformer;

use App\Profiles;
use App\libraries\transformer\Transformer;
use Illuminate\Support\Facades\Input;


class ProfileTransformer extends Transformer
{
    public function transform($data){
        return [
            'Name'=>$data[Profiles::NAME],
            'Address'=>$data[Profiles::ADDRESS],
            'DOB'=>$data[Profiles::DOB],
            'Image'=>$data[Profiles::IMAGE],
        ];
    }
    public function requestAdaptor(){
        return [
            Profiles::NAME => Input::get('name',''),
            Profiles::ADDRESS => Input::get('address',''),
            Profiles::DOB => Input::get('dob',''),
            Profiles::IMAGE => Input::get('image',''),
        ];
    }
}