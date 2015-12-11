<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adv;
use Illuminate\Support\Facades\Validator;
class AdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data=$this->Adv_transformer->requestAdaptor();
        $validator=Validator::make($data,[
            Adv::IMG_URL=>'required',
            Adv::URL=>'required',
            Adv::DESC=>'required',
            Adv::LOCATION=>'required',
        ],
            [
                Adv::IMG_URL.'.required'=>'Image is required try url=<img_url>',
                Adv::URL.'.required'=>'advertisement url is required try url=<url>',
                Adv::DESC.'.required'=>'advertisement description is required try description=<description>',
                Adv::LOCATION.'.required'=>'advertisement location is required try location=<location>',
            ]);
        if($validator->passes()){
            $insert=function($data){
                $advs=new Adv($data);
                return  $advs->save()?$this->success():$this->error('unknown error occurred',520);
            };
            return $insert($data);
            }
        else{
            return $this->error('some error occurred',422);
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
