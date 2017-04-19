<?php

namespace App\Http\Controllers;

use App\OldCheek;
use App\Photo;
use App\Profile;
use App\Services\Vote\VoteResetter;
use App\Traits\AuthTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use AuthTrait;

    private $_vote;
    private $_request;

    public function __construct(Request $request){
        $this->_request =$request;
        $this->authenticate();
    }

    public function index(){
        $profiles= Profile::orderBy('vote', 'desc')->paginate(4);
        $topsix = Profile::orderBy('vote', 'desc')->take(8)->get();
        $w =OldCheek::orderBy('created_at', 'desc')->first();

        $trending = Profile::orderBy('updated_at', 'desc')->take(10)->get();
        $winner=null;
        if($w!=null) {
            $winner = Profile::find($w->profile_id);
        }

        if($this->auth) {
            $profile = Profile::find($this->_userId);
        }
        else
            $profile = new Profile();

        return view('home',
            ['trending' => $trending, 'profiles'=>$profiles, 'topsix'=>$topsix, 'winner'=>$winner,
                'pastwinners'=>$this->pastWinners(), 'profile' => $profile, 'pagination' =>
                ['link' => (string)$profiles->links(),
                    'current_page' => $profiles->currentPage(),
                    'total' => $profiles->total(),
                    'per_page' => $profiles->perPage()
                ]
            ]);
    }


    public  function getContestants($total=10){
        $total =(int)$total;
        if($this->_request->search!=null){
            $search=$this->_request->search;
            $profiles= Profile::where('sex','!=','M')->orderBy('vote', 'desc')
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
                'vote'=>is_null($p->vote)?0:$p->vote,
                'id'=>$p->id,
                'image'=> $p->photo_id!=null && $p->photo_id!=0?Photo::find($p->photo_id)->thumb_path:asset('images/default.png'),
                'photos'=>$p->photos,
                'about'=>$p->about,
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
            $user=User::create([
                'name'=>$profile->first_name." ".$profile->last_name,
                'email'=>$profile->email,
                'password'=>bcrypt('password1')
            ]);
            $profile->user_id =$user->id;
            $profile->update();
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

    public function pastWinners(){
        $chicks =OldCheek::orderBy('created_at', 'desc')->take(10)->get();
        return $chicks;

    }

    public function policy(){
        return view('pages.terms');
    }

}
