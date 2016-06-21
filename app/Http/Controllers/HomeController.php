<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Profile;
use App\Services\VoteService;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{

    private $_vote;

    public function __construct(){
    }



    public function index(){
        return view('home.home');
    }

    //face of the week
    public function winner(){
      $user=Profile::max('vote');
       $profile_pic =Photo::find($user->photo_id);
        return response()->json(['status'=>true,
            'user'=>$user,
            'profile'=>[
                'full_path'=>$profile_pic->full_path,
                'thumb_path'=>$profile_pic->thumb_path
            ],
        ]);
    }
    //contestants
    public function contestants(){
        $winner_id =$this->winner()->id;
     $profile= Profile::where('id','!=',$winner_id)->orderBy('vote', 'desc');
        return response()->json([
           'status'=>true,
            'user'=>$profile
        ]);
    }



}
