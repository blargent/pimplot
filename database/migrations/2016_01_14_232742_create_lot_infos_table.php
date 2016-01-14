<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lot_id')->unsigned();
            $table->integer('lot_num')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('plan_num')->unsigned();
            $table->string('elevation');
            $table->integer('handing_id')->unsigned();
            $table->string('order_num');
            $table->integer('build_type_id')->unsigned();
            $table->date('fv_install_date');
            $table->date('builder_date');
            $table->date('adjust_date_to');
            $table->text('notes');
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
        Schema::drop('lot_infos');
    }
}
