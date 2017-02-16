<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Services\UserService;
use app\Traits\AuthTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use AuthTrait;
    protected $_upload;
    public function __construct(Request $request) {
        $this->request=$request;
        $this->authenticate();
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

        return view('profile',[
            'photos'=>$profile->photos->toArray(),
            'profile'=>$profile]
        );
    }
}
