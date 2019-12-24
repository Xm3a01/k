<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('special_id')->nullable();
            $table->unsignedBigInteger('sub_special_id')->nullable();
            $table->string('qualification')->nullable();
            $table->string('ar_qualification')->nullable();
            $table->string('grade_date')->nullable();
            $table->string('grade')->nullable();
            $table->string('ar_university')->nullable();
            $table->string('university')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('special_id')->references('id')->on('specials')->onDelete('cascade');
            $table->foreign('sub_special_id')->references('id')->on('sub_specials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
