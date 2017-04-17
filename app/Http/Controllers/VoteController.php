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
use Illuminate\Support\Facades\Mail;

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
            ->select('profile_id', 'voter_id',  DB::raw('count(*) as total'))
            ->groupBy('voter_id')
            ->groupBy('profile_id')
            ->orderBy('total', 'DESC')
            ->where('deleted_at', null)
            ->first();

        if($votingResult){
            $winner = Profile::find($votingResult->profile_id);
            $highestVoter = Profile::find($votingResult->voter_id);
            $this->saveWinner($votingResult, $winner, $highestVoter);
            $this->resetVote();
            return response()->json('Vote reset successfully');

        }else{
            return response()->json('No action performed');

        }
    }

    private static function saveWinner($poll, $winner, $highestVoter){
        $now_ = new \DateTime();
        $expiryDate = $now_->modify('+1 month');
        /*todo Get location from the winner's profile*/
        $location = "Eko Hotel and Suite";

        OldCheek::create([
            \TableConstant::PROFILE_ID => $poll->profile_id,
            \OldCheekConstant::WON_DATE =>  $now_,
             \OldCheekConstant::WON_PHOTO => $winner[\ProfileConstant::PHOTO],
             \OldCheekConstant::VOTER => $poll->voter_id,
             \TableConstant::CREATED_AT => $now_
        ]);

        Mail::send('emails.winner', ['user' => $winner, 'voter' => $highestVoter, 'poll' => $poll, 'expiryDate' => $expiryDate, 'location' => $location], function ($m) use ($winner) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $name = $winner->first_name .' '. $winner->last_name;
            $m->to($winner->email, $name)->subject('Congratulation! You are the winner');
        });

        Mail::send('emails.highestVoter', ['winner' => $winner, 'user' => $highestVoter, 'poll' => $poll, 'expiryDate' => $expiryDate, 'location' => $location], function ($m) use ($highestVoter) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $name = $highestVoter->first_name .' '. $highestVoter->last_name;
            $m->to($highestVoter->email, $name)->subject('Congratulation! You just got yourself a date');
        });

        Mail::send('emails.notifyWinnersToTeam', ['winner' => $winner, 'voter' => $highestVoter, 'poll' => $poll, 'expiryDate' => $expiryDate, 'location' => $location], function ($m) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $m->to(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME)->subject('We got winners');
        });
    }

    private static function resetVote(){

        Profile::where('created_at', '!=', null)
            ->update(['vote' => 0]);

        Voter::where('created_at', '!=', null)->delete();

    }


}
