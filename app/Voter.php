<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable = ['ip_address','last_name','phone','email','vote', 'voter_id',
        'user_agent','cookie','profile_id','lat','lon'];


    public  function voter(){
        $this->hasOne('App\Profile','profile_id');
    }
}
