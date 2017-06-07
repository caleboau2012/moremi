<?php

namespace App\Http\Controllers;

use App\Connection;
use App\OldCheek;
use App\Profile;
use App\Venue;
use App\VotingConfig;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use LRedis;

class UIController extends Controller
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

        if($this->loggedIn && ($this->profile == null)) {
            Auth::logout();
            $this->loggedIn = false;
            return redirect(route("index"));
        }
    }

    public function home(){
        $males= Profile::where(\ProfileConstant::SEX, \ProfileConstant::MALE)->count();
        $females = Profile::where(\ProfileConstant::SEX, \ProfileConstant::FEMALE)->count();
        $dates = OldCheek::all();

        $winner =OldCheek::orderBy('created_at', 'desc')->first();

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $partners = Venue::all();

        $votingConfig = VotingConfig::orderBy('created_at', 'desc')->first();

        if($votingConfig == null){
            $voteEnds = null;
        }else{
            $voteEnds = $votingConfig->terminated_at;
        }

        return view('home', [
            'loggedIn' => $this->loggedIn,
            'profile' => $this->profile,
            'winner' => $winner,
            'trending' => $trending,
            'males' => $males,
            'females' => $females,
            'dates' => $dates,
            'partners' => $partners,
            'voteEnds' => $voteEnds
        ]);
    }
    /*user homepage*/
    public function app(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $all = Profile::paginate(10);

        return view('app', ['profile' => $this->profile, 'trending' => $trending, 'all' => $all]);
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

        $photos = $profile->photos->toArray();
        $profile_pic = -1;
        foreach($photos as $i => $photo){
            if($profile->photo->full_path == $photo['full_path'])
                $profile_pic = $i;
        }

        return view('profile',[
                'photos' => $profile->photos()->get()->toArray(),
                'profile' => $profile,
                'profile_pic' => $profile_pic,
                'venues' => $venues,
                'connections' => $connections
            ]
        );
    }
    public function myProfile($id){
        $id = Crypt::decrypt($id);

        $profile = Profile::find($id);

        $connections = Connection::where(\TableConstant::PROFILE_ID, $this->_userId)->
        orWhere(\ConnectionConstant::RECIPIENT_ID, $this->_userId)->get()->toArray();

        for($i = 0; $i < sizeof($connections); $i++){
            if($connections[$i][\TableConstant::PROFILE_ID] != $this->_userId){
                $temp = $connections[$i][\TableConstant::PROFILE_ID];
                $connections[$i][\TableConstant::PROFILE_ID] = $this->_userId;
                $connections[$i][\ConnectionConstant::RECIPIENT_ID] = $temp;
            }

            $user = Profile::find($connections[$i][\ConnectionConstant::RECIPIENT_ID]);
            $connections[$i][\ConnectionConstant::NAME] = $user->first_name . " " . $user->last_name;
            $connections[$i][\ConnectionConstant::PHOTO] = $user->photo()->first();
        }

        $photos = $profile->photos->toArray();
        $profile_pic = -1;
        foreach($photos as $i => $photo){
            if(isset($profile->photo->full_path) && $profile->photo->full_path == $photo['full_path'])
                $profile_pic = $i;
        }

        return view('my_profile',[
                'photos' => $profile->photos()->get()->toArray(),
                'profile' => $profile,
                'profile_pic' => $profile_pic,
                'venue' => $profile->venue()->first(),
                'connections' => $connections
            ]
        );
    }

    public function pastWinners(){
        $chicks =OldCheek::orderBy('created_at', 'desc')->take(10)->get();
        return $chicks;
    }

    public function policy(){
        return view('terms');
    }

}
