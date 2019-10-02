<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbOrderDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_order_detail', function(Blueprint $table)
		{
			$table->integer('order_detail_id', true)->comment('_id');
			$table->integer('product_id')->comment('รหัสสินค้า');
			$table->integer('amount')->default(1)->comment('จำนวน');
			$table->integer('approved_amount')->nullable()->default(0)->comment('จำนวนที่อนุมัติ');
			$table->float('discount_price', 10, 0)->nullable()->comment('ราคาขาย (บาท)');
			$table->integer('order_id')->comment('เลขที่ใบเสนอราคา');
			$table->integer('order_detail_status_id')->nullable()->default(3);
			$table->string('invoice_code', 20)->nullable();
			$table->integer('danger_price')->default(0);
			$table->string('picking_code', 100)->nullable();
			$table->integer('sale_status_id')->nullable();
			$table->string('quotation_code', 191)->nullable();
			
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
		Schema::drop('tb_order_detail');
	}

}
