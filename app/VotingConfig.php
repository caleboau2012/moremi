<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VotingConfig extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['started_at','terminated_at'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'voting_config';

}
