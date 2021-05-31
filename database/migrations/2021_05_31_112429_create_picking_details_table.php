<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePickingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picking_details', function (Blueprint $table) {
            $table->increments('sales_picking_detail_id');
            $table->timestamps();
            $table->integer('product_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('approved_amount')->nullable();
            $table->integer('iv_amount')->nullable();
            $table->integer('before_approved_amount')->nullable();
            $table->float('discount_price')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('order_detail_status_id')->nullable();
            $table->string('invoice_code')->nullable();
            $table->integer('danger_price')->nullable();
            $table->string('picking_code')->nullable();
            $table->integer('sale_status_id')->nullable();
            $table->string('quotation_code')->nullable();
            $table->string('delivery_duration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('picking_details');
    }
}
