<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parteners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partner_name')->nullable();
            $table->string('ar_partner_name')->nullable();
            $table->string('partner_logo')->nullable();
            $table->unsignedBigInteger('about_id');
            $table->timestamps();
            $table->foreign('about_id')->references('id')->on('abouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parteners');
    }
}
