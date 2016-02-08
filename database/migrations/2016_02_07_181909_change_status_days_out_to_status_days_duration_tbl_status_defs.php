<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusDaysOutToStatusDaysDurationTblStatusDefs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_defs', function (Blueprint $table) {
            $table->renameColumn('days_out', 'days_duration');
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
