<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSomeStatusColumnsToNotHaveStatusInName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('status_defs', function (Blueprint $table) {
            $table->renameColumn('status_order', 'order');
            $table->renameColumn('status_name', 'name');
            $table->renameColumn('status_label', 'label');
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
