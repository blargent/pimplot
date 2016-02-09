<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLotNameToTblLotInfosNotethismaybemovetoLotDefsQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_infos', function (Blueprint $table) {
            $table->string('lot_name', 100)->nullable()->after('lot_num');
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
        Schema::table('lot_infos', function (Blueprint $table) {
            //
        });
    }
}
