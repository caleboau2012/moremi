<?php

namespace App\Http\Controllers;

use App\Connection;
use App\OldCheek;
use App\Profile;
use App\Venue;
use App\VotingConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use LRedis;

class UIController extends Controller
{

    public function __construct() {
        $this->loggedIn = false;
        $this->profile = null;
        $this->connections = [];
        $this->profileId = 0;

        $token = session(\AppConstants::AUTH);

        if(isset($token) == true) {
            $this->loggedIn = true;
            $profileId = customdecrypt($token);
            $this->profile =  Profile::find($profileId);

            if($this->profile){
                $this->profileId = $this->profile->id;
                $this->connections = $this->getConnections();
                if($this->profile->email == null ){
                    $this->loggedIn = false;
                    Auth::logout();
                    session()->flush();
                    $this->profile = null;
                }
            }else{
                session()->flush();
                $this->loggedIn = false;
                return redirect(route("index"));
            }

        }

        $this->venues = Venue::where(\VenueConstant::TYPE, \VenueConstant::IN_GAME)->get();
        $this->spots = Venue::all();

        if($this->loggedIn && ($this->profile == null)) {
            Auth::logout();
            session()->flush();
            $this->loggedIn = false;
            return redirect(route("index"));
        }
    }

    public function getConnections(){
        $profileId =  $this->profileId;
        $connections = Connection::where(\TableConstant::PROFILE_ID, $profileId)->
        orWhere(\ConnectionConstant::RECIPIENT_ID, $profileId)->get()->toArray();

        $redis = LRedis::connection();
        $messages = $redis->lrange('message', 0, -1);
        $messages = array_reverse($messages);

        for($i = 0; $i < sizeof($messages); $i++){
            $messages[$i] = json_decode($messages[$i]);
        }

        for($i = 0; $i < sizeof($connections); $i++){
            if($connections[$i][\TableConstant::PROFILE_ID] != $profileId){
                $temp = $connections[$i][\TableConstant::PROFILE_ID];
                $connections[$i][\TableConstant::PROFILE_ID] = $profileId;
                $connections[$i][\ConnectionConstant::RECIPIENT_ID] = $temp;
            }

            $user = Profile::find($connections[$i][\ConnectionConstant::RECIPIENT_ID]);
            $connections[$i][\ConnectionConstant::NAME] = $user->first_name . " " . $user->last_name;
            $connections[$i][\ConnectionConstant::PHOTO] = $user->photo()->first();
            $connections[$i][\ProfileConstant::SEX] = $user->sex;

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

        return view('home', [
            'loggedIn' => $this->loggedIn,
            'profile' => $this->profile,
            'winner' => $winner,
            'trending' => $trending,
            'males' => $males,
            'females' => $females,
            'dates' => $dates,
            'venues' => $this->venues,
            'spots' => $this->spots,
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

        return view('app', [
            'profile' => $this->profile,
            'trending' => $trending,
            'all' => $all,
            'venues' => $this->venues,
            'spots' => $this->spots,
            'connections' => $this->connections,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

    /*user profile*/
    public function profile(Request $request){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $profile = $this->profile;

        $photos = $profile->photos->toArray();
        $profile_pic = -1;

        if($profile->photo){
            foreach($photos as $i => $photo){
                if($profile->photo->full_path == $photo['full_path'])
                    $profile_pic = $i;
            }
        }

        $vote = new VoteController($request);
        $voters = $vote->voters($this->profileId);
        $people = [];

        foreach($voters as $v){
            $person = Profile::find($v->voter_id);
            $people[] = ['profile' => $person, 'count' => $v->total];
        }

        return view('profile',[
                'photos' => $profile->photos()->get()->toArray(),
                'profile' => $profile,
                'profile_pic' => $profile_pic,
                'venues' => $this->venues,
                'spots' => $this->spots,
                'voteEnds' => VotingConfig::termination(),
                'connections' => $this->connections,
                'voters' => $people
            ]
        );
    }
    public function myProfile($id, Request $request){
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

        $vote = new VoteController($request);
        $voters = $vote->voters($id);
        $people = [];

        foreach($voters as $v){
            $person = Profile::find($v->voter_id);
            $people[] = ['profile' => $person, 'count' => $v->total];
        }

        return view('my_profile',[
                'profile' => $this->profile,
                'photos' => $profile->photos()->get()->toArray(),
                'p' => $profile,
                'p_p' => $profile_pic,
                'venue' => $profile->venue()->first(),
                'venues' => $this->venues,
                'spots' => $this->spots,
                'connects' => $connections,
                'voters' => $people,
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
            'venues' => $this->venues,
            'spots' => $this->spots,
            'profile' => $this->profile,
            'connections' => $this->connections,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

    public function faq(){
        return view('faq', [
            'venues' => $this->venues,
            'spots' => $this->spots,
            'profile' => $this->profile,
            'connections' => $this->connections,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

    public function meetReceipt(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        }

        $reference = session("reference");
        $location =session("location");
        $ticket =session("ticket");
        $expiry = session("expiry");
        $winner_id = session("winner_id");

        $user = Profile::find($this->profileId);
        $winner = Profile::find($winner_id);

        if(isset($reference, $location, $ticket, $expiry, $winner_id)) {
            return view("meet", [
                'venues' => $this->venues,
                'spots' => $this->spots,
                'profile' => $this->profile,
                'connections' => $this->connections,
                'voteEnds' => VotingConfig::termination(),
                'reference' => $reference,
                'location' => $location,
                'ticket' => $ticket,
                'expiryDate' => $expiry,
                'winner' => $winner,
                'user' => $user
            ]);
        }
        else{
            return redirect(route("index"));
        }
    }


    public function shutDown(){
        session()->flush();
        $this->loggedIn = false;
        return redirect(route("index"));
    }
}
