<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbInvoiceDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_invoice_detail', function(Blueprint $table)
		{
			$table->integer('invoice_detail_id', true)->comment('_id');
			$table->integer('product_id')->comment('รหัสสินค้า');
			$table->integer('amount')->default(1)->comment('จำนวน');
			$table->float('discount_price', 10, 0)->nullable()->comment('ราคาขาย (บาท)');
			$table->integer('invoice_id')->comment('เลขที่ใบเสนอราคา');
			
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
		Schema::drop('tb_invoice_detail');
	}

}
