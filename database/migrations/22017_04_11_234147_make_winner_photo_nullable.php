<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeWinnerPhotoNullable extends Migration
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
            $table->string('won_photo')->nullable()->change('won_date');
            $table->string('facebook_post_id')->nullable()->change('won_date');

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
        });
    }
}
