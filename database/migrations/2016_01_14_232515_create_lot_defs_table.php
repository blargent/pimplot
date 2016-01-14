<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotDefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_defs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subdivision_id')->unsigned();
            $table->integer('map_id')->unsigned();
            $table->integer('lot_num')->unsigned();
            $table->integer('plan_num')->unsigned();
            $table->integer('priority')->unsigned();
            $table->string('map_area_shape');
            $table->string('map_area_coords');
            $table->string('location_address');
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
        Schema::drop('lot_defs');
    }
}
