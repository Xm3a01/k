<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('ar_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('ar_last_name')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('visit_count')->default(0);
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('ar_gender')->nullable();
            $table->string('gender')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_name_en')->nullable();
            $table->string('logo')->nullable();
            $table->string('avatar')->nullable();
            $table->longText('description')->nullable();
            $table->longText('ar_description')->nullable();
            $table->string('company_email')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')
                    ->references('id')->on('roles')->onDelete('cascade');
   
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
        Schema::dropIfExists('owners');
    }
}
