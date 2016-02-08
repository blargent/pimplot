<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEditedByFieldToStatusDefs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_defs', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable()->after('updated_at');
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
