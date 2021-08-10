<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner');
            $table->foreign('owner')->references('id')->on('users');
            $table->bigInteger('salon_id');
            $table->string('name');
            $table->string('phone');
            $table->string('civil_id')->unique();
            $table->string('email')->nullable();
            $table->string('profile_picture')->nullable();
            $table->json('expert_in')->nullable();
            $table->integer('role');
            $table->integer('rating')->default(0);
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->string('fcm')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
