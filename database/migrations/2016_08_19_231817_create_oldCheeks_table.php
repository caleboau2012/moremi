<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldCheeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_cheeks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id');
            $table->date('won_date');
            $table->integer('won_photo')->nullable();
            $table->string('facebook_post_id')->nullable();
            $table->integer('user_id');
            $table->integer('votes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('old_cheeks');
    }
}
