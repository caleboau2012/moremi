<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable =[
        'thumb_path','full_path','profile_id'
    ];


    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }

}
