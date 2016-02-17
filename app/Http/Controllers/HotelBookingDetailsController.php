<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 17/02/16
 * Time: 12:30 PM
 */
namespace App\Http\Controllers;

use app\Libraries\Transformer\HotelBookingDetailsTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Libraries\Transformer;
use App\HotelBookingDetails;
use Illuminate\Support\Facades\Validator;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class HotelBookingDetailsController extends BaseController
{


    protected $HotelBookingDetailsTransformer;
    function __construct()
    {
        $this->HotelBookingDetailsTransformer = new HotelBookingDetailsTransformer();
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
        $hotelBookingDetails = User::find($user_id)->HotelBookingDetails()->get();
        return $this->respond($this->HotelBookingDetailsTransformer->transformCollection($hotelBookingDetails->toArray()));
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
