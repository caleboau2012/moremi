<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ['first_name','last_name','phone','email','vote',
                            'facebook_id','photo_id','show_private_info'];
}
