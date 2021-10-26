<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberPDFSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_p_d_f_s', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->integer('member_id')->nullable();
            $table->integer('member_subcategory_id')->nullable();
            $table->integer('committee_id')->nullable();
            $table->integer('committee_subcategory_id')->nullable();
            $table->string('pdf_file');
            $table->boolean('is_active');
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
        Schema::dropIfExists('member_p_d_f_s');
    }
}
