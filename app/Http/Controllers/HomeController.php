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

    public  function getContestants($total=10){
//        dd($this->_request);
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
            if($p->venue == 0)
                $venue = "";
            else
                $venue = $p->venue()->first()->name;

            $default = ($p->sex == "male")?'images/default-male.png':'images/default-female.png';

            $data[] =[
                'name'=>$p->first_name." ".$p->last_name,
                'vote'=>is_null($p->vote)?0:$p->vote,
                'id'=>$p->id,
                'venue'=>$venue,
                'venue_id'=>$p->venue,
                'sex'=>$p->sex,
                'image'=> $p->photo_id!=null && $p->photo_id!=0?Photo::find($p->photo_id)->thumb_path:$default,
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

    public function seed(){
        $faker = \Faker\Factory::create();
        for ($i = 1; $i < 11 ;$i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $sex = "female";
            $email = $faker->email;
            $phone = $faker->phoneNumber;
            $facebook_id = $faker->randomNumber(8);

            $user = new User();
            $user->name = $firstName . " " . $lastName;
            $user->email = $email;
            $user->password = bcrypt('password1');
            $user->save();

            $profile = new \App\Profile();
            $profile->first_name = $firstName;
            $profile->last_name = $lastName;
            $profile->sex = $sex;
            $profile->email = $email;
            $profile->phone = $phone;
            $profile->facebook_id = $facebook_id;
            $profile->show_private_info = 0;
            $profile->user_id =$user->id;
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
