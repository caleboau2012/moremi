<?php

namespace App\Http\Controllers;

use App\Connection;
use App\OldCheek;
use App\Profile;
use App\Ticket;
use App\User;
use App\Venue;
use App\VotingConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use LRedis;

class AdminController extends Controller
{

    public function __construct() {
        $this->loggedIn = false;
        $this->profile = null;
        $this->connections = [];
        $this->profileId = 0;

        $token = session(\AppConstants::AUTH);

        if(isset($token) == true) {
            $this->loggedIn = true;
            $profileId = customdecrypt($token);
            $this->profile =  Profile::find($profileId);

            if($this->profile){
                $this->profileId = $this->profile->id;
//                $this->connections = $this->getConnections();
                if($this->profile->email == null ){
                    $this->loggedIn = false;
                    Auth::logout();
                    session()->flush();
                    $this->profile = null;
                }
            }else{
                session()->flush();
                $this->loggedIn = false;
                return redirect(route("index"));
            }

        }

        $this->venues = Venue::where(\VenueConstant::TYPE, \VenueConstant::IN_GAME)->get();
        $this->spots = Venue::all();

        if($this->loggedIn && ($this->profile == null)) {
            Auth::logout();
            session()->flush();
            $this->loggedIn = false;
            return redirect(route("index"));
        }
    }

     public function home(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();

        $all = Profile::paginate(10);

        return view('admin.home', [
            'trending' => $trending,
            'profile' => $this->profile,
            'all' => $all,
            'voteEnds' => VotingConfig::termination()
        ]);
    }

     public function hangout(){
        if(!$this->loggedIn){
            return redirect(route("index"));
        };

        $hangouts = OldCheek::orderBy('id', 'desc')->get();
        $spots = Venue::all();
        $users = Profile::all();

         return view('admin.hangout', [
             'hangouts' => $hangouts,
             'spots' => $spots,
             'profile' => $this->profile,
             'users' => $users
         ]);
    }
     public function setHangout(){
        if(!$this->loggedIn){
            return response()->json([
                "status" => false,
                "msg" => "You must be logged in"
            ]);
        };

        if(Input::has('beneficiaries') && Input::has('spot')){
            if(is_array(Input::get('beneficiaries'))){
                $users = [];
                $spot = Venue::find(Input::get('spot'));

                if($spot){
                    $ticket = Ticket::where(\TableConstant::STATUS, \AppConstants::ACTIVE)->where(\TicketConstant::VENUE_ID, $spot->id)->first();
                    $reference_number = uniqid('TK');

                    if($ticket){
                        $ticket_number = $ticket->code;
                        $now_ = new \DateTime();
                        $activeUserId = $this->profileId; //Auth::id();


                        $user_ids = Input::get('beneficiaries');
                        foreach ($user_ids as $uid){
                            $bu = Profile::find($uid);//->toArray();
                            array_push($users, $bu);

                            $oc = new OldCheek();
                            $oc->profile_id = $uid;
                            $oc->won_photo = $bu->photo_id;
                            $oc->voter_id = $activeUserId;
                            $oc->created_at = $now_;
                            $oc->ticket = $ticket_number;
                            $oc->reference = $reference_number;

                            $oc->save();

                        }

                        foreach ($users as $u){

                            //Ticket Notification Mail
                            Mail::send('emails.hangout', ['user' => $u, 'beneficiaries' => $users, 'spot' => $spot, 'ticket' => $ticket, 'reference' => $reference_number], function ($m) use ($u) {
                                $m->from(\MailConstants::SUPPORT_MAIL, \MailConstants::TEAM_NAME);
                                $name = $u->first_name .' '. $u->last_name;
                                $m->to($u->email, $name)->subject('Congratulations! You just got an Hangout!');
                                $m->bcc(\MailConstants::TEAM_MAIL, \MailConstants::TEAM_NAME);
                            });
                        }

//                        Sold-out Ticket
                        $ticket[\TableConstant::STATUS] = \AppConstants::USED;
                        $ticket[\TableConstant::UPDATED_AT] = new \DateTime();
                        $ticket->save();

                        return response()->json([
                            "status" => true,
                            "message" => "Ticket generated successfully"
                        ]);
                    }else{

                        return response()->json([
                            "status" => false,
                            "message" => 'No ticket available for selected spot.'
                        ], 400);
                    }


                }else{
                    return response()->json([
                        "status" => false,
                        "message" => 'Invalid spot selected'
                    ], 400);
                }

            }else{
                return response()->json([
                    "status" => false,
                    "message" => 'Invalid request'
                ], 400);
            }
        }else{
            return response()->json([
                "status" => false,
                "message" => 'Invalid request'
            ], 400);
        }



    }

}
