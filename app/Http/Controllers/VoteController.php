<?php

namespace App\Http\Controllers;
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
            return response()->json(['status'=>false, 'auth' => false, 'msg'=>'You must be logged in to vote']);
        }
        $vote = new VoteService($request);
        $profile_id =$request->profile_id;
        if($vote->HasVoted($this->_userId)) {
            $msg =['status'=>false, 'auth' => true, 'msg'=>'You only have one free vote in a day. The rest will cost you ₦' . config('constants.price') . ' per vote'];
            return response()->json($msg);
        }
        $vote->vote($profile_id);
        $vote->storeRequest($profile_id,$this->_userId);
        $msg =['status'=>true, 'auth' => true, 'msg'=>'Photo voted successfully','count'=>$vote->count];
        return response()->json($msg)->withCookie(config('settings.vote-cookie-name'), $vote->cookie, 2880);
    }


}
