<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommunityIdToSubdivisionDefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subdivision_defs', function (Blueprint $table) {
            $table->integer('community_id')->unsigned()->nullable()->after('subdivision_name');
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
        Schema::table('subdivision_defs', function (Blueprint $table) {
            //
        });
    }
}
