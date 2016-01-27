<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLotMapIdFkToLotDefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_defs', function (Blueprint $table) {
            //
            $table->foreign('map_id')
                ->references('id')
                ->on('lot_maps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lot_defs', function (Blueprint $table) {
            //
        });
    }
}
