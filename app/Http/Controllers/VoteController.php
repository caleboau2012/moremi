<?php

namespace App\Http\Controllers;

use App\Services\VoteService;
use Illuminate\Http\Request;
use App\Http\Requests;

class VoteController extends Controller
{

    public function  __construct() {

    }

    public function  vote(Requests\VoteRequest $request) {
        $vote = new VoteService($request);
        $profile_id =$request->input('profile_id');
        if($vote->HasVoted($profile_id)) {
            $msg =['status'=>false,'msg'=>'You have voted this profile less than 2 days ago'];

        }
        $vote->vote($profile_id);
        $vote->storeRequest(profile_id);
        $msg =['status'=>true,'msg'=>'Photo voted successfully'];
        return response()->json($msg)
            ->cookie('vote', $vote->cookie);
    }


}
