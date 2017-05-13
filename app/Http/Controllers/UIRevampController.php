<?php

namespace App\Http\Controllers;

use App\OldCheek;
use App\Profile;
use App\Venue;

class UIRevampController extends Controller
{

    public function __construct() {

    }

    public function home(){
        $loggedIn = false;
        $profile = null;

        $token = session(\AppConstants::AUTH);
        if(isset($token) == true) {
            $loggedIn = true;
            $profile = Profile::where('user_id', customdecrypt($token))->first();
        }

        $males= Profile::where(\ProfileConstant::SEX, \ProfileConstant::MALE)->count();
        $females = Profile::where(\ProfileConstant::SEX, \ProfileConstant::FEMALE)->count();
        $dates = OldCheek::all()->count();

        $winner =OldCheek::orderBy('created_at', 'desc')->first();

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $partners = Venue::all();

        return view('uirevamp.home', [
            'loggedIn' => $loggedIn,
            'profile' => $profile,
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
        return view('uirevamp.user');
    }
    /*user profile*/
    public function profile(){
        return view('uirevamp.profile');
    }

}
