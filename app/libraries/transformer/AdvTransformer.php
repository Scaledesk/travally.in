<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 11/12/15
 * Time: 5:11 PM
 */

namespace app\libraries\transformer;

use App\Adv;
use App\libraries\transformer\Transformer;
use Illuminate\Support\Facades\Input;


class AdvTransformer extends Transformer
{
    public function transform($data){
        return [
            'id'=>$data[Adv::ID],
            'img_url'=>$data[Adv::IMG_URL],
            'url'=>$data[Adv::URL],
            'description'=>$data[Adv::DESC],
            'location'=>$data[Adv::LOCATION],
        ];
    }
    public function requestAdaptor(){
        return [
            Adv::IMG_URL => Input::get('img_url',''),
            Adv::URL => Input::get('url',''),
            Adv::DESC => Input::get('description',''),
            Adv::LOCATION => Input::get('location',''),
        ];
    }
}