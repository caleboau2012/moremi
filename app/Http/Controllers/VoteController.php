<?php

namespace App\Http\Controllers;
use App\Connection;
use App\OldCheek;
use App\Profile;
use App\Services\Vote\VoteService;
use App\Http\Requests;
use App\Traits\AuthTrait;
use App\User;
use App\Venue;
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
            return response()->json([
                'status'=>false,
                'auth' => false,
                'msg'=>'You must be logged in to vote'
            ]);
        }

        $profile = Profile::find($this->_userId);
        if(($profile->first_name) && ($profile->last_name) && ($profile->phone) && ($profile->email)){
            $vote = new VoteService($request);
            $profile_id =$request->profile_id;
            if($vote->HasVoted($this->_userId)) {
                $msg =[
                    'status'=>false,
                    'auth' => true,
                    'free' => false,
                    'profile' => true,
                    'msg'=>'You only have one free vote in a day. The rest will cost you.'
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

    /*
     * End the Voting process
     * */
    public function endVotes(){
        $votingResult = DB::table('voters')
            ->select('profile_id', 'voter_id',  DB::raw('SUM(frequency) as total'))
            ->groupBy('voter_id')
            ->groupBy('profile_id')
            ->orderBy('total', 'DESC')
            ->where('deleted_at', null)
            ->get();


        $stack = [];

        if($votingResult){
            foreach($votingResult as $vResult){
                $unique = true;

                foreach($stack as $s) {
                    if ($s->profile_id == $vResult->profile_id)
                        $unique = false;
                }

                if($unique){
                    $stack[] = $vResult;
                    $pick = Profile::find($vResult->profile_id);
                    $picker = Profile::find($vResult->voter_id);
                    $this->createConnection($vResult, $pick, $picker);
                }
                else{
                    continue;
                }
            }

            $winner = Profile::find($votingResult[0]->profile_id);
            $highestVoter = Profile::find($votingResult[0]->voter_id);
            $spot = Venue::find($winner->venue);
            $this->saveWinner($votingResult[0], $winner, $highestVoter, $spot);
            $this->resetVote();
            return response()->json('Vote reset successfully');

        }else{
            return response()->json('No action performed');

        }
    }

    private static function createConnection($poll, $pick, $picker){
        $connection = Connection::where(
            \TableConstant::PROFILE_ID, $poll->profile_id)
            ->where(\ConnectionConstant::RECIPIENT_ID, $poll->voter_id)->first();

        $connection2 = Connection::where(
            \TableConstant::PROFILE_ID, $poll->voter_id)
            ->where(\ConnectionConstant::RECIPIENT_ID, $poll->profile_id)->first();

        if(!$connection && !$connection2 && ($poll->voter_id != $poll->profile_id)){
            Connection::create([
                \TableConstant::PROFILE_ID => $poll->profile_id,
                \ConnectionConstant::RECIPIENT_ID => $poll->voter_id,
            ]);
            $picker_spot = Venue::find($picker->venue);
            $picker_location = ($picker_spot ? $picker_spot->name : "Undisclosed");
            $pick_spot = Venue::find($pick->venue);
            $pick_location = ($picker_spot ? $pick_spot->name : "Undisclosed");
            /*Send to highest picker*/
            Mail::send('emails.connectionAlert', ['connection' => $pick, 'poll' => $poll, 'location' => $pick_location, 'user' => $picker],
                function ($m) use ($picker) {
                $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                $name = $picker->first_name .' '. $picker->last_name;
                $m->to($picker->email, $name)->subject('You just got yourself a new connection on Moore.me');
            });
            /*Send to  Pick*/
            Mail::send('emails.connectionAlert', ['connection' => $picker, 'poll' => $poll, 'location' => $picker_location, 'user' => $pick],
                function ($m) use ($pick) {
                    $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                    $name = $pick->first_name .' '. $pick->last_name;
                    $m->to($pick->email, $name)->subject('You just got yourself a new connection on Moore.me');
                });
        }
    }

    private static function saveWinner($poll, $winner, $highestVoter, $spot){
        $now_ = new \DateTime();
        $expiryDate = $now_->modify('+1 month');

        $location = ($spot ? $spot->name : "Undisclosed");

        $oldCheek = new OldCheek();
        $oldCheek->profile_id = $poll->profile_id;
        $oldCheek->won_date = $now_;
        $oldCheek->won_photo = $winner->photo_id;
        $oldCheek->voter_id = $poll->voter_id;
        $oldCheek->votes = $winner->vote;
        $oldCheek->created_at = $now_;

        $oldCheek->save();

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
