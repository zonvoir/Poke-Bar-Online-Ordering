<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRemovedIngredientsInOrderHasItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_has_items', function (Blueprint $table) {
            $table->string('removed_ingredients')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_has_items', function (Blueprint $table) {
            $table->dropColumn('removed_ingredients');
        });
    }
}
