<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Profile;
use App\Services\Vote\VoteResetter;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private $_vote;
    private $_request;

    public function __construct(Request $request){
        $this->_request =$request;

    }




    public function index(){
        $profiles= Profile::orderBy('vote', 'desc')->paginate(4);
        $topsix = Profile::orderBy('vote', 'desc')->take(8)->get();
        $winner = Profile::whereRaw('vote = (select max(`vote`) from profiles)')->first();
        return view('home',['profiles'=>$profiles,'topsix'=>$topsix,'winner'=>$winner, 'pagination' =>
            ['link' => (string)$profiles->links(),
                'current_page' => $profiles->currentPage(),
                'total' => $profiles->total(),
                'per_page' => $profiles->perPage()
            ]]);
    }


    public  function getContestants($total=10){
        $total =(int)$total;
        if($this->_request->search!=null){
            $search=$this->_request->search;
            $profiles= Profile::orderBy('vote', 'desc')
                 ->where("first_name", "LIKE","%$search%")
                ->orWhere("last_name", "LIKE", "%$search%")
                ->paginate($total);
        }else {
            $profiles = Profile::orderBy('vote', 'desc')
                ->paginate($total);
        }
       $data=[];
        foreach($profiles as $p){
        $data[] =[
            'name'=>$p->first_name." ".$p->last_name,
            'vote'=>$p->vote,
            'id'=>$p->id,
            'image'=>Photo::find($p->photo_id)->thumb_path,
            'photos'=>$p->photo
        ];
       }

        return response()->json(['status'=>true,'data'=>$data,
            'pagination' =>
                ['link' => (string)$profiles->links(),
                    'current_page' => $profiles->currentPage(),
                    'total' => $profiles->total(),
                    'per_page' => $profiles->perPage(),
                    'last_page'=>$profiles->lastPage()
                ]]);

    }

    //profile page
    public function profile(){
        return view('profile');
    }

    //cheek of the week
    public function winner(){
      $user=DB::table('profiles')->where('vote', DB::raw("(select max(`vote`) from profiles)"))->first();
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
    public function getAll(){
     $profile= Profile::orderBy('vote', 'desc')->get();

        $data=[];
        $data['status']=true;
        foreach($profile as $p ){
            $data['user'][] =[
                'profile'=>$p,
                'profile_pic'=>['thumb_path'=>$p->photo->thumb_path,'full_path'=>$p->photo->full_path],
                'photos'=>$p->photos
            ];
        }
        return response()->json([$data]);
    }

    public function test(){
        $new =new VoteResetter();
    }
    public function seed(){

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10 ;$i++) {
            $profile = new \App\Profile();
            $profile->first_name = $faker->firstName;
            $profile->last_name = $faker->lastName;
            $profile->email = $faker->email;
            $profile->phone = $faker->phoneNumber;
            $profile->facebook_id = $faker->randomNumber(8);
            $profile->show_private_info = 0;

            $profile->save();
            for ($a = 0; $a < 6; $a++) {
                $full = $faker->image(config('photo.uploads.full_path'), 600, 400, 'cats');  // 'tmp/13b73edae8443990be1aa8f1a483bc27.jpg' it's a cat!
                $thumb = $faker->image(config('photo.uploads.full_path').DIRECTORY_SEPARATOR.'thumbs', 200, 200, 'cats');  // 'tmp/13b73edae8443990be1aa8f1a483bc27.jpg' it's a cat!
                $photo = \App\Photo::create([
                    'profile_id' => $profile->id,
                    'full_path' => $full,
                    'thumb_path' => $thumb

                ]);
            }
            $profile->update(['photo_id'=>$photo->id]);
        }

    }



}
