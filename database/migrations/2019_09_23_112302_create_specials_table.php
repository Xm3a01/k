<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('ar_name');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('role_id')
                 ->references('id')->on('roles')->onDelete('cascade');
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); //specials
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specials');
        // $table->dropForeign('role_id');
    }
}
