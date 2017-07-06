<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPricesToVenue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('venues', function (Blueprint $table) {
            $table->integer('price')->after('thumb');
            $table->integer('discounted')->after('price');
            $table->integer('type')->after('discounted');
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
        Schema::table('venues', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('discounted');
            $table->dropColumn('price');
        });
    }
}
