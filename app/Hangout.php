<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hangout extends Model
{
    use SoftDeletes;

    //
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    public function beneficiaries(){
        return $this->hasMany('App\OldCheek');
    }
    public function creator(){
        return $this->belongsTo('App\Profile', 'creator_id');
    }
}
