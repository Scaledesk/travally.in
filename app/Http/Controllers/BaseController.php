<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 11/12/15
 * Time: 5:11 PM
 */
namespace App\Http\Controllers;
use App\libraries\Messages;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    /**
     * success response method with default message and success code
     */

    public function __construct()
    {

    }
    public function success($message='success',$status_code=200){
        return [
          'message' =>$message,
            'status_code' =>$status_code
        ];
    }


    /**
     * error response method with default message and error code
     */
    public function error($message='error',$status_code=404){
        return [
          'message'=>$message,
            'status_code'=>$status_code
        ];
    }
}
