<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('map_num')->unsigned();
            $table->string('map_name');
            $table->string('map_filename');
            $table->text('map_storage_location')->nullable();
            $table->integer('subdivision_id')->unsigned();
            $table->integer('community_id')->unsigned();
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
        Schema::drop('lot_maps');
    }
}
