<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 14/12/15
 * Time: 3:11 PM
 */
namespace App\Http\Controllers;
use app\Libraries\Transformer\ProfileTransformer;
use Illuminate\Http\Request;
use App\User;
use App\Profiles;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class ProfileController extends BaseController
{

    protected $ProfileTransformer;

    function __construct()
    {
        $this->ProfileTransformer = new ProfileTransformer();
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
        $user=User::find($id);
        dd($user->profiles());
        return $this->respond($user->profiles());
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
        /**
         * Update profile
         */
        $data = $this->ProfileTransformer->requestAdaptor();
        $data=array_filter($data,'strlen'); // filter blank or null array
        if(sizeof($data)){ try{$result=$this->auth()->user()->profiles()->update($data);}catch(\Exception $e){
            return $this->respondValidationError($e->getMessage());
        }
        }else{
            return $this->respondValidationError('no adequate field passed');
        }
        if($result)
        {
            return $this->respondCreated('updated successfully');
        }
        else
        {
            return $this->respondValidationError('Unknown error');
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
    }
}
