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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VoteResetter
{

    public function __construct(){
        ///back up
    }

    /**Reset vote**/
    public  function reset()
    {
        if ($this->todayIsSunday()) {
            $this->backupWinner();
            $profiles = Profile::all();
            if (!empty($profiles)) {
                foreach ($profiles as $profile) {
                    $profile->vote = 0;
                    $profile->save();
                }
            }
        }
    }

    public function backupWinner(){

        $profile = DB::table('profiles')->where('vote', DB::raw("(select max(`vote`) from profiles)"))->first();
        if($profile->photo_id!=null && $profile->photo_id!=0) {
            $photo = Photo::find($profile->photo_id);
            if (!empty($profile) && !$this->checkIfExist($profile)) {
                OldCheek::create([
                    'profile_id' => $profile->id,
                    'won_date' => date('Y-m-d'),
                    'won_photo' => $photo->full_path
                ]);
                $this->notifyWinner($profile); ///notify winner
            }
        }
    }
    public function checkIfExist($profile){
        $exist =OldCheek::where('won_date',date('Y-m-d'))->where('profile_id',$profile->id)->first();
        if($exist==null ||empty($exist)){
            return false;
        }
        return true;
    }

    public  function todayIsSunday(){
        $dt = Carbon::now();
        if ($dt->dayOfWeek === Carbon::SUNDAY) {
            return true;
        }
        return false;
    }

   public  function notifyWinner($profile) {

   }
}