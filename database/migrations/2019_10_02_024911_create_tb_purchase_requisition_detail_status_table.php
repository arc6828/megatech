<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbPurchaseRequisitionDetailStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_purchase_requisition_detail_status', function(Blueprint $table)
		{
			$table->integer('purchase_requisition_detail_status_id', true);
			$table->string('purchase_requisition_detail_status_name', 100);
			
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
		Schema::drop('tb_purchase_requisition_detail_status');
	}

}
