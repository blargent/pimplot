<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCriticalIssueAndVerifyNoUpdateToLotInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot_infos', function (Blueprint $table) {
            $table->tinyInteger('critical_issue_flag')->unsigned()->nullable()->default(0)->after('adjust_date_to');
            $table->tinyInteger('verify_no_update')->unsigned()->nullable()->default(0)->after('critical_issue_flag');
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
