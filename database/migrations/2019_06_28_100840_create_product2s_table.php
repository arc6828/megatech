<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduct2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product2s', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_detail')->nullable();
            $table->string('brand')->nullable();
            $table->float('promotion_price')->nullable();
            $table->float('floor_price')->nullable();
            $table->float('max_discount_percent')->nullable();
            $table->integer('amount_in_stock')->nullable();
            $table->string('product_unit')->nullable();
            $table->integer('pending_in')->nullable();
            $table->integer('pending_out')->nullable();
            $table->float('normal_price')->nullable();
            $table->string('BARCODE')->nullable();
            $table->float('purchase_price')->nullable();
            $table->string('purchase_ref')->nullable();
            $table->string('ISBN')->nullable();
            $table->integer('quantity')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product2s');
    }
}
