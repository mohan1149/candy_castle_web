<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('salon_id');
            $table->bigInteger('service_id');
            $table->bigInteger('customer_id');
            $table->bigInteger('employee_id')->nullable();
            $table->timestamp('booking_on');
            $table->integer('status')->default(0);// 0 - waiting, 1 - accepted, 2 - completed, 3 - rejected
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
        Schema::dropIfExists('bookings');
    }
}
