<?php

namespace App\Http\Controllers;
use App\OldCheek;
use App\Profile;
use App\Services\Vote\VoteService;
use App\Http\Requests;
use App\Traits\AuthTrait;
use App\User;
use App\Voter;
use Illuminate\Support\Facades\DB;

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

        $votingResult = DB::table('voters')
            ->select('user_id', 'profile_id', 'voter_id',  DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->groupBy('voter_id')
            ->groupBy('profile_id')
            ->orderBy('total', 'DESC')
            ->first();

        if($votingResult){
            $winner = Profile::find($votingResult->profile_id);
            $this->saveWinner($votingResult, $winner);
            $this->resetVote();

        }

        return response()->json('Vote reset successfully');
    }

    private static function saveWinner($poll, $winner){
        $now_ = new \DateTime();
        OldCheek::create([
            \TableConstant::PROFILE_ID => $poll->profile_id,
            \TableConstant::USER_ID => $poll->user_id,
            \OldCheekConstant::WON_DATE =>  $now_,
             \OldCheekConstant::WON_PHOTO => $winner[\ProfileConstant::PHOTO],
             \OldCheekConstant::VOTER => $poll->voter_id,
             \TableConstant::CREATED_AT => $now_
        ]);

        /*todo notify Winner*/


        /*todo notify Highest voter*/


        /*todo notify Admin*/

    }

    private static function resetVote(){

        Profile::where('created_at', '!=', null)
            ->update(['vote' => 0]);

        DB::table('old_cheeks')->delete();

    }


}
