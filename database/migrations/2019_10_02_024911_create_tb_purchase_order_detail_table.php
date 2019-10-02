<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPurchaseOrderDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_purchase_order_detail', function(Blueprint $table)
		{
			$table->integer('purchase_order_detail_id', true)->comment('_id');
			$table->integer('product_id')->comment('รหัสสินค้า');
			$table->integer('amount')->default(1)->comment('จำนวน');
			$table->integer('amount_pending_in')->nullable()->default(0);
			$table->float('discount_price', 10, 0)->nullable()->comment('ราคาขาย (บาท)');
			$table->integer('purchase_order_id')->comment('เลขที่ใบเสนอราคา');
			$table->integer('purchase_order_detail_status_id')->nullable();
			$table->integer('requisition_detail_id')->nullable();
			
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
		Schema::drop('tb_purchase_order_detail');
	}

}
