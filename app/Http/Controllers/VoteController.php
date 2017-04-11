<?php

namespace App\Http\Controllers;
use App\OldCheek;
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
            return response()->json(['status'=>false,'msg'=>'You must be logged in to vote']);
        }
        $vote = new VoteService($request);
        $profile_id =$request->profile_id;
        if($vote->HasVoted($this->_userId)) {
            $msg =['status'=>false,'msg'=>'You can only vote one person in a day'];
            return response()->json($msg);
        }
        $vote->vote($profile_id);
        $vote->storeRequest($profile_id,$this->_userId);
        $msg =['status'=>true,'msg'=>'Photo voted successfully','count'=>$vote->count];
        return response()->json($msg)->withCookie(config('settings.vote-cookie-name'), $vote->cookie, 2880);
    }

    /*
     * End the Voting process
     * */
    public function endVotes(){

        Profile::where('created_at', '!=', null)
            ->update(['vote' => 0]);

//        return response()->json('Vote reset successfully');
        return response()->json(Profile::all());
    }

    private static function saveWinner(Profile $winner){
        OldCheek::create([
            'profile_id' => $winner['profile_id'],
            'won_date'
        ]);
    }


}
