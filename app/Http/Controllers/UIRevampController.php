<?php

namespace App\Http\Controllers;

use App\OldCheek;
use App\Profile;
use App\Venue;

class UIRevampController extends Controller
{
    public function __construct() {
        $this->loggedIn = false;
        $this->profile = null;

        $token = session(\AppConstants::AUTH);
        if(isset($token) == true) {
            $this->loggedIn = true;
            $this->profile = Profile::where('user_id', customdecrypt($token))->first();
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

        return view('uirevamp.profile', ['profile' => $this->profile]);
    }

}
