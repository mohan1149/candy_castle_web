<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner');
            $table->foreign('owner')->references('id')->on('users');
            $table->float('order_cost')->unsigned();
            $table->bigInteger('customer_id');
            $table->string('payment_method')->nullable();
            $table->text('delivery_address');
            $table->string('trasaction_number')->nullable();
            $table->integer('status')->default(0); //0 - submitted, 1 - processing, 2 - shipped, 3 - delivered , 4 - cancelled
            $table->integer('payment_status'); //0 - unpaid,  1 - paid
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
        Schema::dropIfExists('orders');
    }
}
