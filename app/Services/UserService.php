<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 6/8/2016
 * Time: 9:29 AM
 */

namespace App\Services;
use App\Http\Controllers\PhotoController;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\DB;

class UserService
{


    private static $instance = null;

    public function __construct(){


    }

    public static function  instance(){
        if(self::$instance == null) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    public function isValid($profileId){
        $profile = Profile::find($profileId);
        if($profile) {
            return $profile;
        }
        return false;

    }

    public function findOrCreate($facebookUser){
        $facebook_id =$facebookUser->facebook_id; //facebook Id
         $authUser =Profile::where('facebook_id', $facebook_id)->first();
         if($authUser) {
             return [
                 "route" => route("app"),
                 "profile" => $authUser
             ];
         }

         $newUser = null;
         DB::transaction(function () use ($facebookUser, &$newUser) {
             /*
             $user = new User();
             $user->name = $facebookUser->first_name." ".$facebookUser->last_name;
             $user->email = $facebookUser->email;
             $user->password = bcrypt(str_random(8));
             $user->save();*/

             $profile =  Profile::create([
                 'first_name'=>$facebookUser->first_name,
                 'last_name'=>$facebookUser->last_name,
                 'phone'=>$facebookUser->phone,
                 'facebook_id'=>$facebookUser->facebook_id,
                 'email'=>$facebookUser->email,
                 'sex'=>$facebookUser->sex,
//                 'user_id'=>$user->id
             ]);

             $photoController = new PhotoController($facebookUser);
             $photoController->storefb($profile, $facebookUser);
             $newUser = $profile;
         });

         if($newUser != null){
             return [
                 "route" => route('profile'),
                 "profile" => $newUser
             ];
         }

     }
}