<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommunityIdFkToSubdivisionDefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subdivision_defs', function (Blueprint $table) {
            $table->foreign('community_id')
                ->references('id')
                ->on('community_defs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subdivision_defs', function (Blueprint $table) {
            //
        });
    }
}
