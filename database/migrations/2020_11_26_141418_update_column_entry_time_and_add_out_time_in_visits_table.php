<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnEntryTimeAndAddOutTimeInVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits', function (Blueprint $table) {
             $table->dropColumn('entry_time');
        });
        Schema::table('visits', function (Blueprint $table) {
            $table->dateTime('entry_time')->nullable();
            $table->dateTime('out_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn('entry_time');
            $table->dropColumn('out_time');
        });
    }
}
