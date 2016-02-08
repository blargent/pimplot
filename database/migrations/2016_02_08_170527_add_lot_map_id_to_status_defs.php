<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLotMapIdToStatusDefs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_defs', function (Blueprint $table) {
            $table->integer('lot_map_id')->unsigned()->nullable()->after('id');
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
        Schema::table('status_defs', function (Blueprint $table) {
            //
        });
    }
}
