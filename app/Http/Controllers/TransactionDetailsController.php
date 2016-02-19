<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\Transformer\TransactionDetailsTransformer;
use App\TransactionDetails;
use Illuminate\Support\Facades\Validator;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class TransactionDetailsController extends BaseController
{


    protected $TransactionDetailsTransformer;
    function __construct()
    {
        $this->TransactionDetailsTransformer = new TransactionDetailsTransformer();
        $this->middleware('oauth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id=Authorizer::getResourceOwnerId(); // the token user_id
        $transactionDetails = User::find($user_id)->transactionDetails()->get();
        return $this->respond($this->TransactionDetailsTransformer->transformCollection($transactionDetails->toArray()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data=$this->TransactionDetailsTransformer->requestAdaptor();
        $user_id=Authorizer::getResourceOwnerId();
        $data['user_id']=$user_id;
        $validator=Validator::make($data,[
            TransactionDetails::TYPE=>'required',
            TransactionDetails::AMOUNT=>'required',
            TransactionDetails::STATUS=>'required'
        ],
            [
                TransactionDetails::TYPE.'.required'=>'Transaction type is required try type=<type_value>'
            ]);

        if($validator->passes()){



            $transaction = TransactionDetails::create($data);
            //return $transaction;

            //$transaction = Transaction::find($transactionId);
            $data = [];
            $data['transaction'] = $transaction->toArray();
            //$data['booking'] = $transaction->booking;
            //$data['buyer'] = $transaction->booking->buyer->userProfiles->toArray();
            //$data['buyer']['email'] = $transaction->booking->buyer->email;
            $data['callbacks']['success'] = getenv('SERVER_ADDRESS').'/bookingPayment/success';
            $data['callbacks']['failure'] = getenv('SERVER_ADDRESS').'/bookingPayment/failure';
            $data['callbacks']['cancel'] = getenv('SERVER_ADDRESS').'/bookingPayment/cancel';
            return view('payment.payBookingAmount',$data);


            /*$insert=function($data){
                $transaction=new TransactionDetails($data);
                return  $transaction->save()?$this->respondCreated('transaction details saved successfully'):$this->respondValidationError('some error occurred');
            };
            return $insert($data);*/
        }
        else{
            return $this->respondValidationError($validator->messages());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function paymentSuccessFunction(){

    }
    public function paymentFailedFunction(){

    }
    public function paymentCancelFunction(){

    }
}
