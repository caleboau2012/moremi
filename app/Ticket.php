<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    //
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }
}
