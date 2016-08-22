<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 8/20/2016
 * Time: 12:23 AM
 */

namespace app\Services\Vote;


use App\OldCheek;
use App\Profile;

class VoteResetter
{

    public function __construct(){
        ///back up
        $this->backupWinner();
    }

    /**Reset vote**/
    public  function reset(){

        $profiles =Profile::all();
        foreach($profiles as $profile) {
            $profile->vote =0;
            $profiles->save();
        }
    }

    public function backupWinner(){

        $profile =Profile::max('vote');
        if(!empty($profile)&& !$this->checkIfExist()) {
            OldCheek::create([
                'profile_id' => $profile->id,
                'won_date'=>date('Y-m-d'),
                'won_photo'=>$profile->photo->full_path
            ]);
        }
    }

    public function checkIfExist(){
        return false;
    }

}