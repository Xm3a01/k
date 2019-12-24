<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('special_id')->nullable();
            $table->unsignedBigInteger('sub_special_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();

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
                 
            $table->foreign('level_id')
                 ->references('id')->on('levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
