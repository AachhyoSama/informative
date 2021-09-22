<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembercategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membercategories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('slug');
            $table->boolean('member_commities');
            $table->boolean('is_active');

            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('og_image')->nullable();
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
        Schema::dropIfExists('membercategories');
    }
}
