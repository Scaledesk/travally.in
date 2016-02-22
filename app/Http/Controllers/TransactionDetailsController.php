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
        $string = str_random(40);
        $data['user_id']=$user_id;
        $data['travally_transaction_details_txn_id'] = $string;
        $validator=Validator::make($data,[
            TransactionDetails::TYPE=>'required',
            TransactionDetails::AMOUNT=>'required',
            TransactionDetails::STATUS=>'required',
            TransactionDetails::BOOKING_REQUEST=>'required'
        ],
            [
                TransactionDetails::TYPE.'.required'=>'Transaction type is required try type=<type_value>'
            ]);

        if($validator->passes()){



            /*$transaction = TransactionDetails::create($data);
            //return $transaction;
            $user = User::find($user_id);
            //dd($user->profiles->toArray());
            $data = [];
            $data['user'] = $user->profiles->toArray();
            $data['user']['email'] = $user->email;
            $data['transaction'] = $transaction->toArray();
            //$data['booking'] = $transaction->booking;
            //$data['buyer'] = $transaction->booking->buyer->userProfiles->toArray();
            //$data['buyer']['email'] = $transaction->booking->buyer->email;
            $data['callbacks']['success'] = 'http://localhost:8000/bookingPayment/success';
            $data['callbacks']['failure'] = 'http://localhost:8000/bookingPayment/failure';
            $data['callbacks']['cancel'] = 'http://localhost:8000/bookingPayment/cancel';
            return view('payment.payment',$data);*/
            /*getenv('SERVER_ADDRESS').*/

            $insert=function($data){
                //$transaction=new TransactionDetails($data);
                $transaction = TransactionDetails::create($data);
                return $this->respond($this->TransactionDetailsTransformer->transform($transaction));
                //return  $transaction->save()?$this->respondCreated('transaction details saved successfully'):$this->respondValidationError('some error occurred');
            };
            return $insert($data);
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

    public function payBookingAmount($id){

        /*$data = [];
        $data['transaction'] = $transaction->toArray();
        $data['booking'] = $transaction->booking;
        $data['buyer'] = $transaction->booking->buyer->userProfiles->toArray();
        $data['buyer']['email'] = $transaction->booking->buyer->email;
        $data['callbacks']['success'] = getenv('SERVER_ADDRESS').'/bookingAmountPayment/success';
        $data['callbacks']['failure'] = getenv('SERVER_ADDRESS').'/bookingAmountPayment/failure';
        $data['callbacks']['cancel'] = getenv('SERVER_ADDRESS').'/bookingAmountPayment/cancel';
        return view('payment.payBookingAmount',$data);*/



        $transaction = TransactionDetails::find($id);
        $user_id=Authorizer::getResourceOwnerId();
        $user = User::find($user_id);
        //dd($user->profiles->toArray());
        $data = [];
        $data['user'] = $user->profiles->toArray();
        $data['user']['email'] = $user->email;
        $data['transaction'] = $transaction->toArray();
        //$data['booking'] = $transaction->booking;
        //$data['buyer'] = $transaction->booking->buyer->userProfiles->toArray();
        //$data['buyer']['email'] = $transaction->booking->buyer->email;
        $data['callbacks']['success'] = 'http://localhost:8000/bookingPayment/success';
        $data['callbacks']['failure'] = 'http://localhost:8000/bookingPayment/failure';
        $data['callbacks']['cancel'] = 'http://localhost:8000/bookingPayment/cancel';
        return view('payment.payment',$data);
    }




    public function paymentSuccessFunction(){


        $status=$_POST["status"];
        $firstname=$_POST["firstname"];
        $amount=$_POST["amount"];
        $txnid=$_POST["txnid"];
        $posted_hash=$_POST["hash"];
        $key=$_POST["key"];
        $productinfo=$_POST["productinfo"];

        $email=$_POST["email"];
        $salt="eCwWELxi";

        $transaction = TransactionDetails::findOrFail($txnid);
        $transaction->status = $status;
        $transaction->save();

        If (isset($_POST["additionalCharges"])) {
            $additionalCharges=$_POST["additionalCharges"];
            $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

        }
        else {

            $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            echo "Invalid Transaction. Please try again";
        }
        else {
            ?>
            <script>
                window.location.assign("http://www.gozolo.in/#/payment_success");
            </script>
            <?php
            header('Location:http://www.gozolo.in/#/payment_success');
        }


    }
    public function paymentFailedFunction(){

    }
    public function paymentCancelFunction(){

    }
}
