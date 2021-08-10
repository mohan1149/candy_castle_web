<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner');
            $table->foreign('owner')->references('id')->on('users');
            $table->string('name');
            $table->string('sku')->unique();
            $table->longText('description');
            $table->float('weight');
            $table->integer('type')->default(0); //0 - sample, 1 - varaint, 2 - combo
            $table->bigInteger('category_id');
            $table->float('purchase_price')->unsigned();
            $table->float('selling_price')->unsigned();
            $table->integer('stock_quantity')->unsigned();
            $table->string('image');
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
        Schema::dropIfExists('products');
    }
}
