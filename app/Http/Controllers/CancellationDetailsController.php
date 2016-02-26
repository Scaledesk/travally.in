<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Libraries\Transformer\CancellationDetailsTransformer;
use App\CancellationDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
class CancellationDetailsController extends BaseController
{

    protected $CancellationDetailsTransformer;
    function __construct()
    {
        $this->CancellationDetailsTransformer = new CancellationDetailsTransformer();
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
        $cancellationDetails = User::find($user_id)->cancellationDetails()->get();
        return $this->respond($this->CancellationDetailsTransformer->transformCollection($cancellationDetails->toArray()));
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
        $data=$this->CancellationDetailsTransformer->requestAdaptor();
        $user_id=Authorizer::getResourceOwnerId();
        $data['user_id']=$user_id;
        $validator=Validator::make($data,[
            CancellationDetails::STATUS=>'required',
            CancellationDetails::TYPE=>'required',
        ],
            [
                CancellationDetails::STATUS.'.required'=>'Status is required try status=<status>',
                CancellationDetails::TYPE.'.required'=>'Type is required try type=<type>',
            ]);

        if($validator->passes()){
            $insert=function($data){
                $cancellation=new CancellationDetails($data);
                return  $cancellation->save()?$this->respondCreated('cancellation details saved successfully'):$this->respondValidationError('some error occurred');
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
