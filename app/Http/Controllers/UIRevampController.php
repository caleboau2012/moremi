<?php

namespace App\Http\Controllers;

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

//        dd($profile);

        return view('uirevamp.home', [
            'loggedIn' => $loggedIn,
            'profile' => $profile
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
