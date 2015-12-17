<?php

/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 11/12/15
 * Time: 5:11 PM
 */
namespace App\Http\Controllers;
use App\Libraries\Transformer\AdvTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adv;
use Illuminate\Support\Facades\Validator;


class AdvController extends BaseController
{

    protected $AdvTransformer;

    function __construct()
    {
        $this->AdvTransformer = new AdvTransformer();
        //$this->middleware('oauth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $adv= Adv::all()->toArray();
        //return Adv::paginate(2);
        return $this->respond($this->AdvTransformer->transformCollection($adv));
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
        $data=$this->AdvTransformer->requestAdaptor();
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
                return  $advs->save()?$this->respondCreated('advertisement created successfully'):$this->respondValidationError('some error occurred');
            };
            return $insert($data);
            }
        else{
            return $this->respondValidationError($validator->messages());
            //return $validator->messages();
            //return $this->error('some error occurred',422);
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
        $adv=Adv::find($id);
        if(!$adv){
            return $this->respondNotFound('advertisement not exist');
        }
        else{
            return $this->respond($this->AdvTransformer->transform($adv));
        }

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
        $data = $this->AdvTransformer->requestAdaptor();
        $data=array_filter($data,'strlen'); // filter blank or null array
        $adv = Adv::find($id);
        if(!$adv)
        {
            return $this->respondNotFound('calendar event does not exist to update');
        }
        else{
            $adv->update($data);
            return $this->respondDeleted('advertisement updated successfully');
        }





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

        if(Adv::destroy($id))
        {
            return $this->respondDeleted('advertisement deleted successfully');
        }
        else{
            return $this->respondNotFound('Advertisement does not exist');
        }


    }
}
