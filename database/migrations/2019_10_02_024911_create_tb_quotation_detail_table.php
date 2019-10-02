<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbQuotationDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_quotation_detail', function(Blueprint $table)
		{
			$table->integer('quotation_detail_id', true)->comment('_id');
			$table->integer('product_id')->comment('รหัสสินค้า');
			$table->integer('amount')->default(1)->comment('จำนวน');
			$table->float('discount_price', 10, 0)->nullable()->comment('ราคาขาย (บาท)');
			$table->integer('quotation_id')->comment('เลขที่ใบเสนอราคา');
			$table->string('quotation_detail_remark')->nullable()->default('');
			$table->integer('danger_price')->nullable()->default(0);
			$table->integer('sale_status_id')->nullable();
			
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
		Schema::drop('tb_quotation_detail');
	}

}
