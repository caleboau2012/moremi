<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHighestVoterOldCheek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('old_cheeks', function (Blueprint $table) {
            //
            $table->integer('voter_user')->after('user_id');
            $table->integer('voter_profile')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('old_cheeks', function (Blueprint $table) {
            //
            $table->removeColumn('vote_user');
            $table->removeColumn('voter_profile');
        });
    }
}
