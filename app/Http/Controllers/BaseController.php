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
use Illuminate\Http\Response as IlluminateResponse;
class BaseController extends Controller
{
    /**
     * success response method with default message and success code
     */

    public function __construct()
    {

    }
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     *  function for get status code
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * function for set status code
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * function for response
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * function for response not found
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {

        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * function for response with error
     * @param $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]);
    }

    /**
     * function for response with created
     * @param $message
     * @return mixed
     */
    protected function respondCreated($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)
            ->respond(['message' => $message, 'status_code' => $this->getStatusCode()]);
    }

    /**
     * function  response for deleted
     * @param $message
     * @return mixed
     */
    protected function respondDeleted($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)
            ->respond(['message' => $message, 'status_code' => $this->getStatusCode()]);
    }


    /**
     * function for response when validation error occurred
     * @param $message
     * @return mixed
     */
    protected function respondValidationError($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError($message);
    }

    /**
     * function response with pagination
     * @param $standard
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination($standard, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $standard->total(),
                'total_pages'  => ceil($standard->total() / $standard->perPage()),
                'current_page' => $standard->currentPage(),
                'limit'        => $standard->perPage()
            ]
        ]);
        return $this->respond($data);
    }



    /*public function success($message='success',$status_code=200){
        return [
          'message' =>$message,
            'status_code' =>$status_code
        ];
    }*/


    /**
     * error response method with default message and error code
     */
    /*public function error($message='error',$status_code=404){
        return [
          'message'=>$message,
            'status_code'=>$status_code
        ];
    }*/
}
