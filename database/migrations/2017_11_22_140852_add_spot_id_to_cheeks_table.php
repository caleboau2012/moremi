<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpotIdToCheeksTable extends Migration
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
            $table->integer('hangout_id')->nullable()->after('ticket');

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
            $table->dropColumn('hangout_id');
        });
    }
}
