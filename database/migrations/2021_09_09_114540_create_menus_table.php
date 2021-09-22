<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('category_slug');
            $table->integer('position');
            $table->boolean('main_child');
            $table->integer('parent_id')->nullable();
            $table->integer('header_footer')->nullable();


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
        Schema::dropIfExists('menus');
    }
}
