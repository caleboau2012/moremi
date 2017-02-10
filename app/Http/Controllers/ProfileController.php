<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Services\UserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    protected $_upload;
    private $_userId;
    private $auth=false;
    private $request;
    public function __construct(Request $request) {
        $this->request=$request;
        $this->authenticate();
    }

    public  function authenticate(){
        if(session('authToken')!=null) {
            $this->setAuth(session('authToken'));
        }
        $access_token = $this->request->header('authToken');
        if($access_token!=null){
            $this->setAuth($access_token);
        }
    }

    public  function setAuth($token)
    {
        $userId = customdecrypt($token);
        $userInstance = UserService::instance();
        if ($userInstance->isValid($userId)) {
            $this->auth = true;
            $this->_userId = $userId;
        }
    }

    public  function myProfile(){
        if(!$this->auth) {
            return response()->json(['status'=>false,'message'=>'You must be logged in to upload photo']);
        }
        $profile =Profile::find($this->_userId)->first();
        return response()->json([
            'status'=>true,
            'data'=>[
                'status'=>$profile->about,
                'profile_pic'=>$profile->photo->full_path,
                'photos'=>$profile->photos->toArray()
            ]
        ]);
    }


    //profile page
    public function profile(){
        if(!$this->auth) {
            return back();
        }
        $profile =Profile::find($this->_userId)->first();

        return view('profile',['profile_pic'=>$profile->photo->full_path,
            'photos'=>$profile->photos->toArray(),'status'=>$profile->about]);
    }
}
