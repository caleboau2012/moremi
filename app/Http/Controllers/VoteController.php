<?php

namespace App\Http\Controllers;
use App\Connection;
use App\OldCheek;
use App\Photo;
use App\Profile;
use App\Services\Vote\VoteService;
use App\Http\Requests;
use App\Ticket;
use App\Traits\AuthTrait;
use LRedis;
use App\Venue;
use App\Voter;
use App\VotingConfig;
use Carbon\Carbon;
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

        $profile = Profile::where('user_id', $this->_userId)->first();
        if(($profile->first_name) && ($profile->last_name) && ($profile->phone) && ($profile->email)){
            $vote = new VoteService($request);
            $profile_id =$request->profile_id;
            if($vote->HasVoted($this->_userId)) {
                $msg =[
                    'status'=>false,
                    'auth' => true,
                    'free' => false,
                    'profile' => true,
                    'msg'=>'You only have one free vote every hour.'
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
                'msg'=>'Picked successfully',
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
                    if(($vResult === NULL) || ($pick === NULL) || ($picker === NULL)){
                        continue;
                    }
                    else{
                        $this->createConnection($vResult, $pick, $picker);
                    }
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
            $this->resetVotingParam();
            return response()->json('Vote reset successfully');

        }else{
            $this->resetVotingParam();
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
            $pick_location = ($pick_spot ? $pick_spot->name : "Undisclosed");
            /*Send to highest picker*/
            Mail::send('emails.connectionAlert', ['connection' => $pick, 'poll' => $poll, 'location' => $pick_location, 'user' => $picker],
                function ($m) use ($picker) {
                    $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                    $name = $picker->first_name .' '. $picker->last_name;
                    $m->to($picker->email, $name)->subject('You just got yourself a new connection on Moore.me');
                    $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
                });
            /*Send to  Pick*/
            Mail::send('emails.connectionAlert', ['connection' => $picker, 'poll' => $poll, 'location' => $picker_location, 'user' => $pick],
                function ($m) use ($pick) {
                    $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                    $name = $pick->first_name .' '. $pick->last_name;
                    $m->to($pick->email, $name)->subject('You just got yourself a new connection on Moore.me');
                    $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
                });
        }
    }

    public static function saveMeet($winner, $payer, $spot){
        $now_ = new \DateTime();
        $expiryDate = $now_->modify('+1 month');

        $reference_number = uniqid('TK');

        $location = ($spot ? $spot->name : "Undisclosed");

        if($spot){
            $ticket = Ticket::where(\TableConstant::STATUS, \AppConstants::ACTIVE)->where(\TicketConstant::VENUE_ID, $spot->id)->first();

            if($ticket){
                $ticket['status'] = \AppConstants::USED;
                $ticket[\TableConstant::UPDATED_AT] = new \DateTime();
                $ticket->save();
                $ticket_number = $ticket->code;

            }else{
                $ticket_number = 'Undisclosed';
            }
        }else{
            $ticket_number = 'Undisclosed';
        }

        $oldCheek = new OldCheek();
        $oldCheek->profile_id = $winner->id;
        $oldCheek->won_date = $now_;
        $oldCheek->won_photo = $winner->photo_id;
        $oldCheek->voter_id = $payer->id;
        $oldCheek->votes = $winner->vote;
        $oldCheek->created_at = $now_;
        $oldCheek->ticket = $ticket_number;
        $oldCheek->reference = $reference_number;

        $oldCheek->save();

        Mail::send('emails.meet_winner', ['user' => $winner, 'voter' => $payer, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number, 'reference' => $reference_number], function ($m) use ($winner, $payer) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $name = $winner->first_name .' '. $winner->last_name;
            $payer_name = $payer->first_name . ' ' . $payer->last_name;
            $m->to($winner->email, $name)->subject('Hello! Your connection, ' . $payer_name . ' has booked a spot for you to meet');
            $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
        });

        Mail::send('emails.meet_payer', ['winner' => $winner, 'user' => $payer, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number, 'reference' => $reference_number], function ($m) use ($payer) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $name = $payer->first_name .' '. $payer->last_name;
            $m->to($payer->email, $name)->subject('Congratulations! You just got yourself a hangout');
            $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
        });

        Mail::send('emails.notifyMeetToTeam', ['winner' => $winner, 'voter' => $payer, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number, 'reference' => $reference_number], function ($m) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $m->to(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME)->subject('We got winners');
        });

        if($spot){
            /*notify spot*/
            Mail::send('emails.notifyMeetToSpot', ['winner' => $winner, 'voter' => $payer, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number,  'reference' => $reference_number], function ($m)  use($spot){
                $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                $m->to($spot->email, $spot->name)->subject('We got winners on Moore.me');
                $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
            });
        }

        return [ "reference" => $reference_number, "ticket" => $ticket_number, "expiry" => $expiryDate];
    }

    private static function saveWinner($poll, $winner, $highestVoter, $spot){
        $now_ = new \DateTime();
        $expiryDate = $now_->modify('+1 month');

        $reference_number = uniqid('TK');

        $location = ($spot ? $spot->name : "Undisclosed");

        if($spot){
            $ticket = Ticket::where(\TableConstant::STATUS, \AppConstants::ACTIVE)->where(\TicketConstant::VENUE_ID, $spot->id)->first();

            if($ticket){
                $ticket['status'] = \AppConstants::USED;
                $ticket[\TableConstant::UPDATED_AT] = new \DateTime();
                $ticket->save();
                $ticket_number = $ticket->code;

            }else{
                $ticket_number = 'Undisclosed';
            }
        }else{
            $ticket_number = 'Undisclosed';
        }

        $oldCheek = new OldCheek();
        $oldCheek->profile_id = $poll->profile_id;
        $oldCheek->won_date = $now_;
        $oldCheek->won_photo = $winner->photo_id;
        $oldCheek->voter_id = $poll->voter_id;
        $oldCheek->votes = $winner->vote;
        $oldCheek->created_at = $now_;
        $oldCheek->ticket = $ticket_number;
        $oldCheek->reference = $reference_number;

        $oldCheek->save();

        Mail::send('emails.winner', ['user' => $winner, 'voter' => $highestVoter, 'poll' => $poll, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number, 'reference' => $reference_number], function ($m) use ($winner) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $name = $winner->first_name .' '. $winner->last_name;
            $m->to($winner->email, $name)->subject('Congratulations! You are the winner');
            $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
        });

        Mail::send('emails.highestVoter', ['winner' => $winner, 'user' => $highestVoter, 'poll' => $poll, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number, 'reference' => $reference_number], function ($m) use ($highestVoter) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $name = $highestVoter->first_name .' '. $highestVoter->last_name;
            $m->to($highestVoter->email, $name)->subject('Congratulations! You just got yourself a hangout');
            $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
        });

        Mail::send('emails.notifyWinnersToTeam', ['winner' => $winner, 'voter' => $highestVoter, 'poll' => $poll, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number, 'reference' => $reference_number], function ($m) {
            $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
            $m->to(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME)->subject('We got winners');
        });

        if($spot){
            /*notify spot*/
            Mail::send('emails.notifyWinnersToSpot', ['winner' => $winner, 'voter' => $highestVoter, 'poll' => $poll, 'expiryDate' => $expiryDate, 'location' => $location, 'ticket' => $ticket_number,  'reference' => $reference_number], function ($m)  use($spot){
                $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                $m->to($spot->email, $spot->name)->subject('We got winners on Moore.me');
                $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
            });
        }

    }

    private static function resetVote(){

        Profile::where('created_at', '!=', null)
            ->update(['vote' => 0]);

        Voter::where('created_at', '!=', null)->delete();

    }

    private static function resetVotingParam(){
        $now = new \DateTime();

        $votingParam = new VotingConfig();
        $votingParam[\VotingConfigConstant::STARTED_AT] = $now;
        $terminationDate = new \DateTime();
        $terminationDate->modify('+7 day');
        $votingParam[\VotingConfigConstant::TERMINATED_AT] = $terminationDate;

        $votingParam->save();
    }

    /*Daily CRON of Poll  stat*/
    public function dailyPollStat()
    {
        /*send mail*/
        $today = Carbon::today();
        $people = Profile::all();
        $spots = Venue::all();

        $connections = [];

        foreach($people as $i => $p){
            $connections[$i][\ConnectionConstant::PROFILE] = $p;
            $connections[$i][\ConnectionConstant::CONNECTIONS] = $this->getConnections($p->id);

            foreach($connections[$i][\ConnectionConstant::CONNECTIONS] as $j => $connect){
                if(isset($connect[\ConnectionConstant::MESSAGES])) {
                    for ($k = 0; $k < sizeof($connect[\ConnectionConstant::MESSAGES]); $k++) {
                        $date = Carbon::parse($connect[\ConnectionConstant::MESSAGES][$k]->time);
                        if ($today->gt($date))
                            unset($connections[$i][\ConnectionConstant::CONNECTIONS][$j][\ConnectionConstant::MESSAGES][$k]);
                        if ($connect[\ConnectionConstant::MESSAGES][$k]->id_user_from == $connect[\TableConstant::PROFILE_ID])
                            unset($connections[$i][\ConnectionConstant::CONNECTIONS][$j][\ConnectionConstant::MESSAGES][$k]);
                    }
                    if(empty($connections[$i][\ConnectionConstant::CONNECTIONS][$j][\ConnectionConstant::MESSAGES]))
                        unset($connections[$i][\ConnectionConstant::CONNECTIONS][$j]);
                }
                else{
                    unset($connections[$i][\ConnectionConstant::CONNECTIONS][$j]);
                }
            }
        }

        $now = $today->toDateString();
        $poll = DB::table('voters')
            ->select('profile_id', DB::raw('SUM(frequency) as total'))
            ->groupBy('profile_id')
            ->orderBy('total', 'DESC')
            ->whereDate(\TableConstant::CREATED_AT, '=', $now)
            ->where('deleted_at', null)
            ->get();

        foreach ($poll as $p){
            for($i = 0; $i < sizeof($connections); $i++){
                if($p->profile_id == $connections[$i][\ConnectionConstant::PROFILE]->id){
                    $connections[$i][\ConnectionConstant::POLL] = $p;
                }
            }
        }

        $people = $people->toArray();

        for($i = 0; $i < sizeof($connections); $i++){
            for($j = 0; $j < config('settings.suggestions'); $j++){
                $no = rand(0, sizeof($people) - 1);

                while($people[$no]['sex'] == $connections[$i][\ConnectionConstant::PROFILE]->sex)
                    $no = rand(0, sizeof($people) - 1);

                $people[$no]["photo"] = Photo::find($people[$no]["photo_id"]);
                $connections[$i]['suggestions'][$j] = $people[$no];
            }
        }

//        dd($connections);

        foreach($connections as $c){
//            $c = $connections[0];
            $picked = $c[\ConnectionConstant::PROFILE];
            Mail::send('emails.dailyPollVote', [
                'picked' => $picked,
                'poll' => (isset($c[\ConnectionConstant::POLL]))?$c[\ConnectionConstant::POLL]:null,
                'connections' => (isset($c[\ConnectionConstant::CONNECTIONS]))?$c[\ConnectionConstant::CONNECTIONS]:null,
                'suggestions' => $c['suggestions'],
                'spots' => $spots
            ], function ($m)  use($picked){
                $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                $m->to($picked->email)->subject('What you missed on Moore.me');
//                $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
            });
        }

        return response()->json('Polls sent successfully');
    }

    public function voters($profile_id){
        $poll = DB::table('voters')
            ->select('profile_id', 'voter_id', DB::raw('SUM(frequency) as total'))
            ->groupBy('voter_id')
            ->orderBy('total', 'DESC')
            ->where('profile_id', $profile_id)
            ->where('deleted_at', null)
            ->get();

        return $poll;
    }

    public function getConnections($id){
        $connections = Connection::where(\TableConstant::PROFILE_ID, $id)->
        orWhere(\ConnectionConstant::RECIPIENT_ID, $id)->get()->toArray();

        $redis = LRedis::connection();
        $messages = $redis->lrange('message', 0, -1);
        $messages = array_reverse($messages);

        for($i = 0; $i < sizeof($messages); $i++){
            $messages[$i] = json_decode($messages[$i]);
        }

        for($i = 0; $i < sizeof($connections); $i++){
            if($connections[$i][\TableConstant::PROFILE_ID] != $id){
                $temp = $connections[$i][\TableConstant::PROFILE_ID];
                $connections[$i][\TableConstant::PROFILE_ID] = $id;
                $connections[$i][\ConnectionConstant::RECIPIENT_ID] = $temp;
            }

            $user = Profile::find($connections[$i][\ConnectionConstant::RECIPIENT_ID]);
            $connections[$i][\ConnectionConstant::NAME] = $user->first_name . " " . $user->last_name;
            $connections[$i][\ConnectionConstant::PHOTO] = $user->photo()->first();
            $connections[$i][\ProfileConstant::SEX] = $user->sex;

            foreach($messages as $m){
                if((($m->id_user_from == $connections[$i][\TableConstant::PROFILE_ID])
                        && ($m->id_user_to == $connections[$i][\ConnectionConstant::RECIPIENT_ID]))
                    || (($m->id_user_from == $connections[$i][\ConnectionConstant::RECIPIENT_ID])
                        && ($m->id_user_to == $connections[$i][\TableConstant::PROFILE_ID]))){
                    $connections[$i][\ConnectionConstant::MESSAGES][] = $m;
                }
            }
        }

        return $connections;
    }
}
