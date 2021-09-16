<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_messages', function (Blueprint $table) {
            $table->id();
            $table->longText('mission_vision')->nullable();
            $table->longText('founder_message')->nullable();
            $table->string('welcome_title')->nullable();
            $table->string('welcome_sub_title')->nullable();
            $table->longText('welcome_message')->nullable();
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
        Schema::dropIfExists('mission_messages');
    }
}
