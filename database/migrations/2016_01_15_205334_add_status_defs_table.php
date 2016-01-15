<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusDefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_defs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('build_type_id')->unsigned();
            $table->integer('status_order');
            $table->string('status_name')->nullable();
            $table->string('status_label')->nullable();
            $table->integer('days_out')->nullable();
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
        Schema::drop('status_defs');
    }
}
