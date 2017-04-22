<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ['first_name','last_name','phone','email','vote',
                            'facebook_id','photo_id','show_private_info','about','user_id','sex'];



    public function photos()
    {
        return $this->hasMany('App\Photo','profile_id','id');
    }



    public function photo()
    {
        return $this->hasOne('App\Photo','id','photo_id');
    }

    public function venue()
    {
        return $this->hasOne('App\Venue','id','venue');
    }


    public function oldCheeks(){
        return $this->hasMany('App\OldCheek', 'profile_id', 'id');
    }

    public function pastWins(){
        return $this->hasMany('App\OldCheek', 'voter_id', 'id');
    }

}
