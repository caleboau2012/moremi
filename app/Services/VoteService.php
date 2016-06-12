<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 6/11/2016
 * Time: 8:51 PM
 */

namespace App\Services;


use App\Profile;
use App\Vote;
use App\Voter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Cookie;

class VoteService
{

    private $_request;
    public $cookie;
    public function __construct($request) {
    $this->_request =$request;
    }

    public function  vote($profile_id) {
        $profile =Profile::find($profile_id);
        if(!is_null($profile_id)) {
            $profile->vote =$profile->vote+config('settings.vote_counter');
            $profile->save();
            return true;
        }
        return false;

    }

    public function  HasVoted($profile_id){
        $cookie = $this->_request->cookie('vote');
        $date =Carbon::parse(config('settings.days_allow_before_next_vote').' days ago')->toDateTimeString(); //2 days ago
        $row =Voter::where('cookie',$cookie)->where('created_at','>',$date)->where('profile_id',$profile_id)->first();
        if(empty($row)){
            $row =Voter::where('ip_address',$this->_request->ip())->where('user_agent',$this->_request->user_agent)->where('created_at','>',$date)->where('profile_id',$profile_id)->first();
        }
        if(empty($row)){
            return false;
        }
        return true;
    }


    public function storeRequest($profile_id) {
        //$cookie = Cookie::queue('vote', str_random(48), 2880);
        $this->cookie =str_random(48);
        $array=[
            'ip_address'=>$this->_request->ip(),
            'user_agent'=>$this->_request->header('User-Agent'),
            'cookie'=>$this->cookie,
            'profile_id'=>$profile_id
        ];
        $vote =new Voter($array);
        $vote->save();
    }

}