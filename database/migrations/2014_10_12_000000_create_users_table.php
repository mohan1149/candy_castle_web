<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_primary');
            $table->string('phone_secondary')->nullable();
            $table->string('email');
            $table->string('civil_id')->unique();
            $table->string('profile_picture')->nullable();
            $table->string('governorate');
            $table->string('area');
            $table->string('city');
            $table->string('block');
            $table->string('street');
            $table->string('house_number');
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
