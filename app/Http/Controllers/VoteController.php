<?php

namespace App\Http\Controllers;
use App\Services\Vote\VoteService;
use App\Http\Requests;

class VoteController extends Controller
{

    public function  __construct() {

    }

    public function  vote(Requests\VoteRequest $request) {
        $vote = new VoteService($request);
        $profile_id =$request->profile_id;
        if($vote->HasVoted($profile_id)) {
            $msg =['status'=>false,'msg'=>'You can only vote one person in a day'];
            return response()->json($msg);
        }
        $vote->vote($profile_id);
        $vote->storeRequest($profile_id);
        $msg =['status'=>true,'msg'=>'Photo voted successfully','count'=>$vote->count];
        return response()->json($msg)->withCookie(config('settings.vote-cookie-name'), $vote->cookie, 2880);
    }


}
