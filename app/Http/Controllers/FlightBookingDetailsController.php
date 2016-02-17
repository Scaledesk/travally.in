<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 20/01/16
 * Time: 01:44 PM
 */
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Libraries\Transformer\FlightBookingDetailsTransformer;
use App\Http\Requests;
use App\FlightBookingDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class FlightBookingDetailsController extends BaseController
{

    protected $FlightBookingDetailsTransformer;
    function __construct()
    {
        $this->FlightBookingDetailsTransformer = new FlightBookingDetailsTransformer();
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
        $flightBookingDetails = User::find($user_id)->flightBookingDetails()->get();
        return $this->respond($this->FlightBookingDetailsTransformer->transformCollection($flightBookingDetails->toArray()));
        //return User::find($user_id)->flightBookingDetails()->get();
    }
//travally_user_flight_booking_details_source
//travally_user_flight_booking_details_source
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
        $data=$this->FlightBookingDetailsTransformer->requestAdaptor();
        $user_id=Authorizer::getResourceOwnerId();
        $data['user_id']=$user_id;
        $validator=Validator::make($data,[
            FlightBookingDetails::SOURCE=>'required',
            FlightBookingDetails::DESTINATION=>'required',
            FlightBookingDetails::BOOKING_ID=>'required',
            FlightBookingDetails::PNR=>'required',
            FlightBookingDetails::DEPARTURE_DATE=>'required',
            FlightBookingDetails::USER_ID=>'required',
        ],
            [
                FlightBookingDetails::SOURCE.'.required'=>'Source is required try source=<source>',
                FlightBookingDetails::DESTINATION.'.required'=>'Destination is required try destination=<destination>',
                FlightBookingDetails::BOOKING_ID.'.required'=>'Booking id  is required try booking_id=<booking_id>',
                FlightBookingDetails::PNR.'.required'=>'PNR is required try pnr=<pnr>',
                FlightBookingDetails::DEPARTURE_DATE.'.required'=>'Departure date is required try departure_date=<departure_date>'
            ]);

        if($validator->passes()){
            $insert=function($data){
                $flightBooking=new FlightBookingDetails($data);
                return  $flightBooking->save()?$this->respondCreated('flight booking saved successfully'):$this->respondValidationError('some error occurred');
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
