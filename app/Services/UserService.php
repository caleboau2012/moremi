<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 6/8/2016
 * Time: 9:29 AM
 */

namespace App\Services;
use App\Profile;
use App\User;

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

     public function isValid($userId){
         $count = Profile::where('id', $userId)->count();
         if($count==1) {
             return true;
         }
         return false;

     }

     public function findOrCreate($facebookUser){
        $facebook_id =$facebookUser->facebook_id; //facebook Id
         $authUser =Profile::where('facebook_id', $facebook_id)->first();
         if($authUser) {
             return $authUser;
         }
         return Profile::create([
             'first_name'=>$facebookUser->first_name,
             'last_name'=>$facebookUser->last_name,
             'phone'=>$facebookUser->phone,
             'facebook_id'=>$facebookUser->facebook_id,
             'email'=>$facebookUser->email
         ]);
     }

}