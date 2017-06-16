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

    public static function termination(){
        $votingConfig = VotingConfig::orderBy('created_at', 'desc')->first();

        if($votingConfig == null){
            $voteEnds = null;
        }else{
            $voteEnds = $votingConfig->terminated_at;
        }
        return $voteEnds;
    }

}
