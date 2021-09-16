<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('opening_advertisement');
            $table->string('opening_advertisement_url');
            $table->integer('is_show');

            $table->string('header_advertisement');
            $table->string('header_advertisement_url');

            $table->string('middle_ad_one');
            $table->string('middle_ad_one_url');

            $table->string('middle_ad_two');
            $table->string('middle_ad_two_url');

            $table->string('middle_ad_three');
            $table->string('middle_ad_three_url');

            $table->string('middle_ad_four');
            $table->string('middle_ad_four_url');

            $table->string('main_advertisement');
            $table->string('main_advertisement_url');
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
        Schema::dropIfExists('advertisements');
    }
}
