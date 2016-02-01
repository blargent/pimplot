<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommunityIdFkToLotMapsTableFromCommunityDefsId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_maps', function (Blueprint $table) {
            $table->foreign('community_id')
                ->references('id')
                ->on('community_defs');
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
