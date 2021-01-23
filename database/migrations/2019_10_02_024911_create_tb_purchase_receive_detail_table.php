<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPurchaseReceiveDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_purchase_receive_detail', function(Blueprint $table)
		{
			$table->integer('purchase_receive_detail_id', true)->comment('_id');
			$table->integer('product_id')->comment('รหัสสินค้า');
			$table->integer('amount')->default(1)->comment('จำนวน');
			$table->float('discount_price', 10, 0)->nullable()->comment('ราคาขาย (บาท)');
			$table->integer('purchase_receive_id')->comment('เลขที่ใบเสนอราคา');
			$table->string('purchase_receive_detail_remark')->nullable()->default('');
			$table->integer('purchase_order_detail_id')->nullable();
			
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
		Schema::drop('tb_purchase_receive_detail');
	}

}
