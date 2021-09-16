<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('email');
            $table->string('contact_no');
            $table->integer('province_no');
            $table->integer('district_no');
            $table->string('local_address');
            $table->string('company_logo');
            $table->string('company_favicon');
            $table->string('pan_vat');

            $table->string('projects_completed');
            $table->string('clients_satisfied');
            $table->string('award_winner');

            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();

            $table->longText('aboutus')->nullable();
            $table->string('from_day')->nullable();
            $table->string('to_day')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('closing_time')->nullable();

            $table->longText('map_url')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
