<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_assistants', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('chat_id');
           $table->longText('message');
           $table->unsignedBigInteger('restorant_id');
           $table->enum('reciever',['manager','server']);
           $table->longText('response_msg')->nullable();
           $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_assistants');
    }
}
