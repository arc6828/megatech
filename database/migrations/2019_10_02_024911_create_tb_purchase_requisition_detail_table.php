<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPurchaseRequisitionDetailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_purchase_requisition_detail', function(Blueprint $table)
		{
			$table->integer('purchase_requisition_detail_id', true)->comment('_id');
			$table->integer('product_id')->comment('รหัสสินค้า');
			$table->integer('amount')->default(1)->comment('จำนวน');
			$table->float('discount_price', 10, 0)->nullable()->comment('ราคาขาย (บาท)');
			$table->integer('purchase_requisition_id')->comment('เลขที่ใบเสนอราคา');
			$table->integer('purchase_requisition_detail_status_id')->nullable()->default(3);
			$table->string('purchase_requisition_detail_remark')->nullable()->default('');
			$table->integer('supplier_id')->nullable()->comment('เจ้าซื้อ');
			
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
		Schema::drop('tb_purchase_requisition_detail');
	}

}
