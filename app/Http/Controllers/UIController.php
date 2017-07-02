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
        $this->connections = [];

        $token = session(\AppConstants::AUTH);

        if(isset($token) == true) {
            $this->loggedIn = true;
            $this->_userId = customdecrypt($token);
            $this->profile = Profile::where('user_id', $this->_userId)->first();
            $this->connections = $this->getConnections();
        }

        if($this->loggedIn && ($this->profile == null)) {
            Auth::logout();
            $this->loggedIn = false;
            return redirect(route("index"));
        }
    }

    public function getConnections(){
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

        return $connections;
    }

    public function home(){
        $males= Profile::where(\ProfileConstant::SEX, \ProfileConstant::MALE)->count();
        $females = Profile::where(\ProfileConstant::SEX, \ProfileConstant::FEMALE)->count();
        $dates = OldCheek::all();

        $winner =OldCheek::orderBy('created_at', 'desc')->first();

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $partners = Venue::all();

        return view('home', [
            'loggedIn' => $this->loggedIn,
            'profile' => $this->profile,
            'winner' => $winner,
            'trending' => $trending,
            'males' => $males,
            'females' => $females,
            'dates' => $dates,
            'venues' => $partners,
            'connections' => $this->connections,
            'voteEnds' => VotingConfig::termination()
        ]);
    }
    /*user homepage*/
    public function app(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $all = Profile::paginate(10);
        $venues = Venue::all();

        return view('app', [
            'profile' => $this->profile,
            'trending' => $trending,
            'all' => $all,
            'venues' => $venues,
            'connections' => $this->connections,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

    /*user profile*/
    public function profile(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $venues = Venue::all();

        $profile = $this->profile;

        $photos = $profile->photos->toArray();
        $profile_pic = -1;
        foreach($photos as $i => $photo){
            if($profile->photo->full_path == $photo['full_path'])
                $profile_pic = $i;
        }

        $vote = new VoteController();
        $voters = $vote->voters($this->_userId);
        $people = [];

        foreach($voters as $v){
            $person = Profile::find($v->voter_id);
            $people[] = ['profile' => $person, 'count' => $v->total];
        }

        return view('profile',[
                'photos' => $profile->photos()->get()->toArray(),
                'profile' => $profile,
                'profile_pic' => $profile_pic,
                'venues' => $venues,
                'voteEnds' => VotingConfig::termination(),
                'connections' => $this->connections,
                'voters' => $people
            ]
        );
    }
    public function myProfile($id){
        $id = Crypt::decrypt($id);

        $profile = Profile::find($id);

        $connections = Connection::where(\TableConstant::PROFILE_ID, $id)->
        orWhere(\ConnectionConstant::RECIPIENT_ID, $id)->get()->toArray();

        for($i = 0; $i < sizeof($connections); $i++){
            if($connections[$i][\TableConstant::PROFILE_ID] != $id){
                $temp = $connections[$i][\TableConstant::PROFILE_ID];
                $connections[$i][\TableConstant::PROFILE_ID] = $id;
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
        $venues = Venue::all();

        return view('my_profile',[
                'profile' => $this->profile,
                'photos' => $profile->photos()->get()->toArray(),
                'p' => $profile,
                'p_p' => $profile_pic,
                'venue' => $profile->venue()->first(),
                'venues' => $venues,
                'connects' => $connections,
                'connections' => $this->connections,
                'voteEnds' => VotingConfig::termination()
            ]
        );
    }

    public function pastWinners(){
        $chicks =OldCheek::orderBy('created_at', 'desc')->take(10)->get();
        return $chicks;
    }

    public function policy(){
        return view('terms', [
            'profile' => $this->profile,
            'connections' => $this->connections,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

    public function faq(){
        return view('faq', [
            'profile' => $this->profile,
            'connections' => $this->connections,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

}
