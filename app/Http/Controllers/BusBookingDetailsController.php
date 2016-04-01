<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 16/02/16
 * Time: 03:44 PM
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Libraries\Transformer\BusBookingDetailsTransformer;
use App\BusBookingDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
class BusBookingDetailsController extends BaseController
{


    protected $BusBookingDetailsTransformer;
    function __construct()
    {
        $this->BusBookingDetailsTransformer = new BusBookingDetailsTransformer();
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
        $busBookingDetails = User::find($user_id)->busBookingDetails()->get();
        return $this->respond($this->BusBookingDetailsTransformer->transformCollection($busBookingDetails->toArray()));
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

        $data=$this->BusBookingDetailsTransformer->requestAdaptor();
        $user_id=Authorizer::getResourceOwnerId();
        $data['user_id']=$user_id;
        $validator=Validator::make($data,[
            BusBookingDetails::SOURCE=>'required',
            BusBookingDetails::DESTINATION=>'required',
            BusBookingDetails::TICKET_NO=>'required',
            BusBookingDetails::STATUS=>'required',
            BusBookingDetails::DEPARTURE_DATE=>'required',
            BusBookingDetails::USER_ID=>'required',
        ],
            [
                BusBookingDetails::SOURCE.'.required'=>'Source is required try source=<source>',
                BusBookingDetails::DESTINATION.'.required'=>'Destination is required try destination=<destination>',
                BusBookingDetails::TICKET_NO.'.required'=>'Ticket No  is required try ticket_no=<booking_id>',
                BusBookingDetails::STATUS.'.required'=>'STATUS is required try status=<pnr>',
                BusBookingDetails::DEPARTURE_DATE.'.required'=>'Departure date is required try departure_date=<departure_date>'
            ]);

        if($validator->passes()){
            $insert=function($data){
                $busBooking=new BusBookingDetails($data);
                return  $busBooking->save()?$this->respondCreated('bus booking saved successfully'):$this->respondValidationError('some error occurred');
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
}
