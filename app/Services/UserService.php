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



     public function isValid($userId){
         $count = User::where('facebook_id', $userId)->count();
         if($count==1) {
             return true;
         }
         return false;

     }

     public function findOrCreate(array $facebookUser){
        $facebook_id =$facebookUser->facebook_id; //facebook Id
         $authUser =Profile::where('facebook_id', $facebook_id)->first();
         if($authUser) {
             return $authUser;
         }
         return Profile::create($facebookUser);
     }

}