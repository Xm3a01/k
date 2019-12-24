<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrincingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('princings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('have_one')->nullable();
            $table->string('have_tow')->nullable();
            $table->string('have_three')->nullable();
            $table->string('have_four')->nullable();
            $table->string('price')->nullable();
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
        Schema::dropIfExists('princings');
    }
}
