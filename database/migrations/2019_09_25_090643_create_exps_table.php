<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('company_name');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('special_id')->nullable();
            $table->unsignedBigInteger('sub_special_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('expert_year');
            $table->unsignedBigInteger('expert_month');
            $table->string('expert_pdf');
            $table->string('ar_summary')->nullable();
            $table->string('summary')->nullable();
            $table->unsignedBigInteger('start_year');
            $table->unsignedBigInteger('start_month');
            $table->unsignedBigInteger('end_year');
            $table->unsignedBigInteger('end_month');
            
            $table->timestamps();

            $table->foreign('user_id')
               ->references('id')->on('users')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('exps');
    }
}
