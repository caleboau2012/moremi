<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 8/20/2016
 * Time: 12:57 AM
 */

namespace App\Services\Photo;


use App\Photo;
use App\Profile;

class DeletePhoto
{

    public $msg;
    private $photo_id;
    private $user_id;
    public  function __construct($user_id,$id){
        $this->user_id=$user_id;
        $this->photo_id=$id;
    }

    public function delete(){
        if($this->ValidateDelete() && $this->PhotoOwnerCheck()){
            Photo::destroy($this->photo_id);
            return true;
        }
        return false;
    }

    public function ValidateDelete(){
    $profile =Profile::find($this->user_id);
      if($profile->photo_id==$this->photo_id) {
          $this->msg="Can not delete profile photo. You have to change it before you can delete it";
          return false;
      }
        return true;
    }

    public  function PhotoOwnerCheck(){
        $photo =Photo::find($this->photo_id);
        if($photo->profile_id==$this->user_id){
            return true;
        }
        $this->msg='You cannot delete photo that is not yours';
        return false;
    }

}