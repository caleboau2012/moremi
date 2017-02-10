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
    public function __construct(Request $request) {
        $access_token = $request->header('authToken');
        $userId =null;
        if(!is_null($access_token)) {
            $userId =customdecrypt($access_token);
            $userInstance = UserService::instance();
            if($userInstance->isValid($userId)){
                $this->auth =true;
            }
        }
        $this->_userId =$userId;
    }



    public  function myProfile(){
        if(!$this->auth) {
            return response()->json(['status'=>false,'message'=>'You must be logged in to upload photo']);
        }
       $profile =Profile::find($this->_userId);
        return response()->json([
            'status'=>true,
            'data'=>[
            'status'=>$profile->about,
            'profile_pic'=>$profile->photo,
            'photos'=>$profile->photos
                ]

        ]);
    }


    //profile page
    public function profile(){
        if(!$this->auth) {
           return back();
        }
        $profile =Profile::find($this->_userId);

        return view('profile',['profile_pic'=>$profile->photo,
            'photos'=>$profile->photos,'status'=>$profile->about]);
    }
}
