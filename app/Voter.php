<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable = ['ip_address','last_name','phone','email','vote',
        'user_agent','cookie','profile_id','lat','lon'];

}
