<?php

namespace App\Http\Controllers;

use App\OldCheek;
use App\Profile;

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

        $profiles= Profile::orderBy('vote', 'desc')->paginate(4);
        $topsix = Profile::orderBy('vote', 'desc')->take(8)->get();
        $winner =OldCheek::orderBy('created_at', 'desc')->first();

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        return view('uirevamp.home', [
            'loggedIn' => $loggedIn,
            'profile' => $profile,
            'winner' => $winner,
            'trending' => $trending
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
