<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Connection extends Model
{
    //
    use SoftDeletes;

    protected  $fillable =['profile_id','recipient_id'];
}
