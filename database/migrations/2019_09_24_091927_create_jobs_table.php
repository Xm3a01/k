<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('yearsOfExper');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('special_id')->nullable();
            $table->unsignedBigInteger('sub_special_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('selary')->default('-'); 
            $table->integer('selected')->default(0);
            $table->longText('description')->nullable();
            $table->longText('ar_description')->nullable();
            $table->string('status');
            $table->string('ar_status');
            $table->timestamps();


            $table->foreign('role_id')
                 ->references('id')->on('roles')->onDelete('cascade');

            $table->foreign('special_id')
                 ->references('id')->on('specials')->onDelete('cascade');

            $table->foreign('sub_special_id')
                 ->references('id')->on('sub_specials')->onDelete('cascade');

            $table->foreign('country_id')
                 ->references('id')->on('countries')->onDelete('cascade');

            $table->foreign('city_id')
                 ->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
