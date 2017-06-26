<?php

namespace App\Http\Controllers;

use App\Connection;
use App\Profile;
use App\Services\UserService;
use App\Traits\AuthTrait;
use App\Venue;
use Illuminate\Http\Request;
use LRedis;

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
        $profile =Profile::find($this->_userId);
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

        $venues = Venue::all();

        $profile = Profile::find($this->_userId);

        $connections = Connection::where(\TableConstant::PROFILE_ID, $this->_userId)->
        orWhere(\ConnectionConstant::RECIPIENT_ID, $this->_userId)->get()->toArray();

        $redis = LRedis::connection();
        $messages = $redis->lrange('message', 0, -1);
        $messages = array_reverse($messages);

        for($i = 0; $i < sizeof($messages); $i++){
            $messages[$i] = json_decode($messages[$i]);
        }

        for($i = 0; $i < sizeof($connections); $i++){
            if($connections[$i][\TableConstant::PROFILE_ID] != $this->_userId){
                $temp = $connections[$i][\TableConstant::PROFILE_ID];
                $connections[$i][\TableConstant::PROFILE_ID] = $this->_userId;
                $connections[$i][\ConnectionConstant::RECIPIENT_ID] = $temp;
            }

            $user = Profile::find($connections[$i][\ConnectionConstant::RECIPIENT_ID]);
            $connections[$i][\ConnectionConstant::NAME] = $user->first_name . " " . $user->last_name;
            $connections[$i][\ConnectionConstant::PHOTO] = $user->photo()->first();

            foreach($messages as $m){
                if((($m->id_user_from == $connections[$i][\TableConstant::PROFILE_ID])
                    && ($m->id_user_to == $connections[$i][\ConnectionConstant::RECIPIENT_ID]))
                || (($m->id_user_from == $connections[$i][\ConnectionConstant::RECIPIENT_ID])
                        && ($m->id_user_to == $connections[$i][\TableConstant::PROFILE_ID]))){
                    $connections[$i][\ConnectionConstant::MESSAGES][] = $m;
                }
            }
        }

        return view('profile',[
                'photos' => $profile->photos->toArray(),
                'profile' => $profile,
                'venues' => $venues,
                'connections' => $connections
            ]
        );
    }

    //edit account details
    public function updateAccountDetails(Requests\UpdateAccountRequest $request){
        if(!$this->auth) {
            return response()->json([
                "status" => false,
                "msg" => "You must be logged in to updateProfile"
            ]);
        }
        else{
            $profile = Profile::find($this->_userId);

            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->phone = $request->phone;
            $profile->email = $request->email;
            $profile->venue = $request->venue;

            $profile->save();

            return response()->json([
                'status' => true,
                'msg' => "Profile saved successfully"
            ]);
        }
    }
}
