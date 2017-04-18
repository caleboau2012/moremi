<?php

namespace App\Http\Controllers;
use App\Profile;
use App\Services\Vote\VoteService;
use App\Http\Requests;
use App\Traits\AuthTrait;

class VoteController extends Controller
{
use AuthTrait;

    public function __construct() {

    }

    public function  vote(Requests\VoteRequest $request) {
        $this->request=$request;
        $this->authenticate();
        if(!$this->auth){
            return response()->json([
                'status'=>false,
                'auth' => false,
                'msg'=>'You must be logged in to vote'
            ]);
        }

        $profile = Profile::find($this->_userId)->first();
        if(($profile->first_name) && ($profile->last_name) && ($profile->phone) && ($profile->email) &&
            ($profile->card_no) && ($profile->expiry_month) && ($profile->expiry_month) && ($profile->cvv)){
            $vote = new VoteService($request);
            $profile_id =$request->profile_id;
            if($vote->HasVoted($this->_userId)) {
                $msg =[
                    'status'=>false,
                    'auth' => true,
                    'free' => false,
                    'profile' => true,
                    'msg'=>'You only have one free vote in a day. The rest will cost you ₦' . config('constants.price') . ' per vote'
                ];
                return response()->json($msg);
            }

            $vote->vote($profile_id);
            $vote->storeRequest($profile_id,$this->_userId);
            $msg =[
                'status'=>true,
                'auth' => true,
                'free' => true,
                'profile' => true,
                'msg'=>'Photo voted successfully',
                'count'=>$vote->count
            ];
            return response()->json($msg)->withCookie(config('settings.vote-cookie-name'), $vote->cookie, 2880);
        }
        else{
            $msg =[
                'status'=>false,
                'auth' => true,
                'profile' => false,
                'msg'=>'Your profile is not set up correctly, please edit your profile with valid details'];
            return response()->json($msg);
        }
    }


}
