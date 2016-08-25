<?php
/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 8/20/2016
 * Time: 12:23 AM
 */

namespace App\Services\Vote;


use App\OldCheek;
use App\Photo;
use App\Profile;
use Illuminate\Support\Facades\DB;

class VoteResetter
{

    public function __construct(){
        ///back up
        $this->backupWinner();
    }

    /**Reset vote**/
    public  function reset(){

        $profiles =Profile::all();
        if(!empty($profiles)) {
            foreach ($profiles as $profile) {
                $profile->vote = 0;
                $profile->save();
            }
        }
    }

    public function backupWinner(){

        $profile = DB::table('profiles')->where('vote', DB::raw("(select max(`vote`) from profiles)"))->first();
        $photo =Photo::find($profile->photo_id);
        if(!empty($profile)&& !$this->checkIfExist()) {
            OldCheek::create([
                'profile_id' => $profile->id,
                'won_date'=>date('Y-m-d'),
                'won_photo'=>$photo->full_path
            ]);
        }
    }
    public function checkIfExist(){
        return false;
    }

}