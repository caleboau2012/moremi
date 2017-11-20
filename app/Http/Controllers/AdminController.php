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

class AdminController extends Controller
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
//                $this->connections = $this->getConnections();
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

     public function home(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $all = Profile::paginate(10);

        return view('admin.home', [
            'trending' => $trending,
            'profile' => $this->profile,
            'all' => $all,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

     public function hangout(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $hangouts = OldCheek::orderBy('id', 'desc')->get();
        $users = Profile::all();

         return view('admin.hangout', [
             'hangouts' => $hangouts,
             'profile' => $this->profile,
             'users' => $users
         ]);
    }

}
