<?php

namespace App\Http\Controllers;

use App\Connection;
use App\OldCheek;
use App\Profile;
use App\Venue;
use LRedis;

class UIRevampController extends Controller
{
    public function __construct() {
        $this->loggedIn = false;
        $this->profile = null;
        $this->_userId = 0;

        $token = session(\AppConstants::AUTH);

        if(isset($token) == true) {
            $this->loggedIn = true;
            $this->_userId = customdecrypt($token);
            $this->profile = Profile::where('user_id', $this->_userId)->first();
        }
    }

    public function home(){
        $males= Profile::where(\ProfileConstant::SEX, \ProfileConstant::MALE)->count();
        $females = Profile::where(\ProfileConstant::SEX, \ProfileConstant::FEMALE)->count();
        $dates = OldCheek::all()->count();

        $winner =OldCheek::orderBy('created_at', 'desc')->first();

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $partners = Venue::all();

        return view('uirevamp.home', [
            'loggedIn' => $this->loggedIn,
            'profile' => $this->profile,
            'winner' => $winner,
            'trending' => $trending,
            'males' => $males,
            'females' => $females,
            'dates' => $dates,
            'partners' => $partners
        ]);
    }
    /*user homepage*/
    public function user(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $all = Profile::paginate(10);

        return view('uirevamp.user', ['profile' => $this->profile, 'trending' => $trending, 'all' => $all]);
    }

    /*user profile*/
    public function profile(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $venues = Venue::all();

        $profile = $this->profile;

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

        return view('uirevamp.profile',[
                'photos' => $profile->photos()->get()->toArray(),
                'profile' => $profile,
                'venues' => $venues,
                'connections' => $connections
            ]
        );
    }

}
