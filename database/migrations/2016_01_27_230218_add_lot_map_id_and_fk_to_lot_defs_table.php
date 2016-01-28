<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLotMapIdAndFkToLotDefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_defs', function (Blueprint $table) {
            $table->integer('lot_map_id')->unsigned()->nullable();


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
        Schema::table('lot_defs', function (Blueprint $table) {
            //
        });
    }
}
