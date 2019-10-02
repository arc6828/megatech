<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbDeliveryTemporaryDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_delivery_temporary_detail', function(Blueprint $table)
		{
			$table->integer('delivery_temporary_detail_id', true)->comment('_id');
			$table->integer('product_id')->comment('รหัสสินค้า');
			$table->integer('amount')->default(1)->comment('จำนวน');
			$table->float('discount_price', 10, 0)->nullable()->comment('ราคาขาย (บาท)');
			$table->integer('delivery_temporary_id')->comment('เลขที่ใบเสนอราคา');
			$table->string('delivery_temporary_detail_remark')->nullable()->default('');
			$table->integer('danger_price')->default(0);
			
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
		Schema::drop('tb_delivery_temporary_detail');
	}

}
