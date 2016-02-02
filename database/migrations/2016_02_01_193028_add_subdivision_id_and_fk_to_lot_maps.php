<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubdivisionIdAndFkToLotMaps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_maps', function (Blueprint $table) {
            $table->integer('subdivision_id')->unsigned()->nullable()->after('map_num');
            $table->foreign('subdivision_id')->references('id')->on('subdivision_defs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lot_maps', function (Blueprint $table) {
            //
        });
    }
}
