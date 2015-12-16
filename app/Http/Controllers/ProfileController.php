<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 14/12/15
 * Time: 3:11 PM
 */
namespace App\Http\Controllers;
use App\Libraries\Transformer\ProfileTransformer;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use App\User;
use App\Profile;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class ProfileController extends BaseController
{
    protected $ProfileTransformer;

    function __construct()
    {
        $this->ProfileTransformer = new ProfileTransformer();
        $this->middleware('oauth');
    }


    /**
     * Display the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        // function for getting profile
        $user_id=Authorizer::getResourceOwnerId(); // the token user_id
        $user=User::find($user_id);// get the user data from database
        //return $user->profiles()->get();
        return $this->respond($this->ProfileTransformer->transformCollection($user->profiles()->get()->toArray()));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /**
         * Update profile
         */
        $data = $this->ProfileTransformer->requestAdaptor();
        $data=array_filter($data,'strlen'); // filter blank or null array
        if(sizeof($data)){ try{
            $user_id=Authorizer::getResourceOwnerId(); // the token user_id
            $user=User::find($user_id);
            $result = $user->profiles()->update($data);
        }catch(\Exception $e){
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
