<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardToProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('profiles', function($table)
        {
            $table->bigInteger('card_no')->after('venue');
            $table->integer('cvv')->after('card_no');
            $table->integer('expiry_year')->after('cvv');
            $table->integer('expiry_month')->after('expiry_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('profiles', function($table)
        {
            $table->dropColumn('card_no');
            $table->dropColumn('cvv');
            $table->dropColumn('expiry_year');
            $table->dropColumn('expiry_month');
        });
    }
}
