<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropCommunityIdForeignKeyAndColumnFromLotMaps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_maps', function (Blueprint $table) {
            $table->dropForeign('lot_maps_community_id_foreign');
            $table->dropColumn('community_id');
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
