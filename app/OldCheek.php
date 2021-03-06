<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldCheek extends Model
{

    protected  $table= "old_cheeks";
    protected  $fillable =['profile_id','won_date','won_photo'];


    public  function profile(){
        return $this->hasOne('App\Profile','id','profile_id');
    }

    public function picker(){
        return $this->hasOne('App\Profile','id','voter_id');
    }

//    public function spot(){
//        return $this->belongsTo('App\Venues', 'ticket', '')
//    }
}
