<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{

    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip_address');

            $table->string('user_agent');

            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('cookie')->nullable();
            $table->integer('frequency')->default(1);

            $table->integer('profile_id');
            $table->integer('user_id');
            $table->integer('voter_id');

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
        Schema::drop('voters');
    }
}
