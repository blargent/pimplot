<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaglocationsIdColAndFkToCommunityDefsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('community_defs', function (Blueprint $table) {
            $table->integer('taglocation_id')->unsigned()->nullable()->after('community_name');
            $table->foreign('taglocation_id')->references('id')->on('taglocations');
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
        Schema::table('community_defs', function (Blueprint $table) {
            //
        });
    }
}
