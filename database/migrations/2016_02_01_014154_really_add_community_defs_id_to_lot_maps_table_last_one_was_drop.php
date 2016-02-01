<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReallyAddCommunityDefsIdToLotMapsTableLastOneWasDrop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_maps', function (Blueprint $table) {
            $table->integer('community_id')->unsigned()->nullable()->after('id');
            //
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
