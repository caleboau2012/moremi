<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 6/11/2016
 * Time: 8:51 PM
 */

namespace App\Services\Vote;


use App\Profile;
use App\Voter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class VoteService
{

    private $_request;
    public $cookie;
    public $count;
    public function __construct($request) {
    $this->_request =$request;
        if(Cookie::get(config('settings.vote-cookie-name'))){
            $this->cookie =Cookie::get(config('settings.vote-cookie-name'));
        }
        else{
            $this->cookie =str_random(50);
        }
    }

    public function  vote($profile_id, $count=0) {
        $profile =Profile::find($profile_id);
        if(!is_null($profile_id)) {

            $profile->vote =$profile->vote + config('settings.vote_counter') + $count;
            $profile->save();
            $this->count=$profile->vote;
            return true;
        }
        return false;

    }

    public function  HasVoted($voter_id){
        $cookie = $this->_request->cookie('vote');
        $date =Carbon::parse(config('settings.days_allow_before_next_vote').' days ago')->toDateTimeString(); //2 days ago
        $rw =Voter::where('voter_id',$voter_id)->where('created_at','>',$date)->first();
        if(empty($rw)){
            return false;
        }
       /** $row =Voter::where('cookie',$cookie)->where('created_at','>',$date)->first();

        if(empty($row)){
            $row =Voter::where('ip_address',$this->_request->ip())->where('user_agent',$this->_request->user_agent)->where('created_at','>',$date)->first();
        }**/
        return true;
    }


    public function storeRequest($profile_id,$voter_id,$frequency=1) {
        //$cookie = Cookie::queue('vote', str_random(48), 2880);
        //$this->cookie =str_random(48);
//        die(var_dump($frequency));
        $array=[
            'ip_address'=>$this->_request->ip(),
            'user_agent'=>$this->_request->header('User-Agent'),
            'cookie'=>$this->cookie,
            'frequency'=>$frequency,
            'profile_id'=>$profile_id,
            'voter_id'=>$voter_id
        ];
        $vote =new Voter($array);
        $vote->save();
    }


}